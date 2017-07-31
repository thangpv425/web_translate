<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	/*
	* @todo show all words to admin
	* @return Illuminate\resource\views\admin\keyword_list
	*/
    public function wordList(){   	    	
        $meaning=Meaning::all();
        return view('admin.keyWordlist',['meaning'=>$meaning]);
    }
    
    public function getKeywordAdd(){
        return view('admin.keywordAdd');
    }
    
    public function postKeywordAdd(Request $request){
        try {
            DB::beginTransaction();
            $this->validate($request,[
                'txtKeyWord' => 'required|alpha|unique:wt_keyword,keyword',
                'txtMeaning' => 'required|alpha'
            ]);
            $keyword = new keyword();
            $keyword->keyword = $request->txtKeyWord;
            $keyword->status = APPROVED;
            $keyword->save();
        
            $meaning = new meaning();
            $meaning->keyword_id = $keyword->id;
            $meaning->meaning = $request->txtMeaning;
            $meaning->index = 1; //muc do uu tien cao nhat
            $meaning->status = APPROVED;
            $meaning->language = $request->language;
            $meaning->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('admin/keywordList');
    }
    
    /*
    *@todo allow admin to solf delete word 
    */
    public function deleteWord($id){
    	try {
            DB::beginTransaction();
            $meaning= meaning::where($id)->first();
            $meaning->status= DELETED;
            $meaning->save();
            DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    	}
    	$meaning= meaning::all();
    	return view('admin.keyWordlist',['meaning'=>$meaning]);
    }
}
