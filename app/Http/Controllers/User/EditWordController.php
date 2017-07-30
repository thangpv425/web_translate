<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keyword;
use App\Meaning;
use App\KeywordTemp;
use App\MeaningTemp;
use Sentinel;
use Illuminate\Support\Facades\DB;

class EditWordController extends Controller
{
	/*
	* @todo show edit page to user
    * @return Illuminate\resources\views\user\edit_word
	*/
	public function showEditPage($id) {
       //get keyword and all meanings corresponding to keyword_id
		$keyword = Keyword::where('id',$id)->first();
		$meaning= $keyword->meaning;
		return view('user.edit_word',['keyword'=>$keyword,'meaning'=>$meaning]);
	}

    /*
    * insert edited data to temporary table 'keyword_temp' and 'meaning_temp'
    */
    public function wordEdit(Request $request) {   
        $this->validate($request,[
                'keyword' => 'required|alpha|max:255', 
                'comment_keyword' => 'nullable|string|max:255'           
            ]);
        //validate all meaning field
        $i=0;
        foreach($request->meaning as $meaning){
            $this->validate($request,[
                'meaning.'.$i => 'required|string|max:255',  
                'comment.'.$i => 'nullable|string|max:255'            
            ]);
            $i++;
        }

    	define('EDIT', 1,true); 
    	$success=true; // status: editted successfully or not
    	//check if newKeyword differents from oldKeyword then add to keyword_temp table 
    	DB::beginTransaction();	    	
    	try {    		
    		$oldKeyword= Keyword::find($request->keyword_id);
    		if ($oldKeyword->keyword != $request->keyword)
    		{
    			$keywordTemp= new KeywordTemp();    			
    			$keywordTemp->user_id= Sentinel::getUser()->id;
    			$keywordTemp->old_keyword_id= $request->keyword_id;
    			$keywordTemp->new_keyword= $request->keyword;
                $keywordTemp->opCode= EDIT;
    			$keywordTemp->comment= $request->comment_keyword;

    			$keywordTemp->save();
    			DB::commit();
    		}
    	} catch (\Exception $e) {
    		DB::rollback();
    		$success=false;
    	}
    	//check if meaning or language are editted then add to meaning_temp table  
    	$i=0; //bien dem
    	foreach ($request->meaning as $newMeaning)
    	{

    		DB::beginTransaction();
    		try 
    		{
    			$oldMeaning = Meaning::find($request->meaning_id[$i]); 
    			$oldLanguage= $oldMeaning->language;   		
    			if ($oldMeaning->meaning != $newMeaning || $oldLanguage != $request->language[$i])
    			{
    				$meaningTemp= new MeaningTemp();   			
    				$meaningTemp->keyword_id= $request->keyword_id;
    				$meaningTemp->user_id= Sentinel::getUser()->id;
    				$meaningTemp->old_meaning_id= $request->meaning_id[$i];
    				$meaningTemp->new_meaning= $newMeaning;
    				$meaningTemp->language= $request->language[$i];
    				$meaningTemp->index= 1;
                    $meaningTemp->opCode= EDIT;
    				$meaningTemp->comment= $request->comment[$i];    			

    				$meaningTemp->save();
    				DB::commit();
    			}
    		} catch (\Exception $e) {
    			DB::rollback(); 
    			$success=false;   		
    		}
    		$i++;
    	}
    	if ($success==true)
    		$message='Edit request sent, waiting to be approved by admin';
    	else $message='Edit fail';
    	return redirect('user/keywordEdit/'.$request->keyword_id)->with('notification',$message);

    }
}
