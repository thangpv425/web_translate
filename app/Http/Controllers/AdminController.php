<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KeywordTemp;
use App\MeaningTemp;
use App\User;
use App\Keyword;
use App\Meaning;

class AdminController extends Controller
{
	/**
	 * return List request of keyword table
	 * @return [type] [description]
	 */
    public function listKeywordTemp()
    {
    	$data = KeywordTemp::all();
    	return view('admin.queue.keyword.list', ['data' => $data]);
    }

    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function approveKeyword(Request $request)
    {
    	// echo $id;
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
            $keyword = Keyword::find($data->old_keyword_id);
            switch ($opCode) {
                case '0': // Add
                    $keyword->status = 1;
                    break;
                case '1': // Edit
                    $keyword->value = $data['new_keyword'];
                    break;
                case '2': // Delete
                    $keyword->status = 0;
                    break;
                default:
                    return redirect('whatAreUDoing');//->route('keywordTempList');
                    break;
            }
            $keyword->save();
            $data->delete();
    	}
    	return redirect()->route('keywordTempList');
    }

    /**
     * Decline request on keyword table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function declineKeyword(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0': // Decline Add
	    			// Delete row on wt_keyword table
	    			// Delete meaning on wt_meaning_temp table
	    			$keyword = Keyword::find($data['old_keyword_id']);
	    			$data->delete();
	    			$keyword->delete();
	    			break;
	    		case '1': // Decline Edit
	    		case '2': // Decline Delete
	    			$data->delete();
	    			break;	
	    		default:
                    return redirect('whatAreUDoing');
	    			break;
    		}	
    	}
    	return redirect()->route('keywordTempList');
    }

    /**
     * return list request on meaning table
     * @return [type] [description]
     */
    public function listMeaningTemp()
    {
    	$data = MeaningTemp::all();
    	return view('admin.queue.meaning.list', ['data' => $data]);
    }

    public function approveMeaning(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = MeaningTemp::find($id);
    	if ($data != null) {
        	switch ($opCode) {
	    		case '0':
	    			$meaning = new Meaning;
	    			$meaning->value = $data['new_meaning'];
	    			$meaning->language = $data['language'];
	    			$meaning->index = $data['index'];
                    $meaning->keyword_id = $data['keyword_id'];
                    $meaning->status = 1;
	    			break;
	    		case '1': // Edit
	    			$meaning = Meaning::find($data['old_meaning_id']);
	    			$meaning->value = $data['new_meaning'];
	    			break;
	    		case '2': // Delete
	    			$meaning = Meaning::find($data['old_meaning_id']);
	    			$meaning->status = 0;
	    			break;
	    		default:
                    return redirect('whatAreUDoing');
	    			break;
    		}
    		$meaning->save();
	    	$data->delete();
    	}
    	return redirect()->route('meaningTempList');
    }

    public function declineMeaning(Request $request)
    {
    	$data = MeaningTemp::find($request->id);
    	if($data != null){
    		$data->delete();
    	}
    	return redirect()->route('meaningTempList');
    }
    
}
