<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KeywordTemp;
use App\MeaningTemp;
use App\Users;
use App\keyword;
use App\meaning;

class AdminController extends Controller
{
	/**
	 * return List request of keyword table
	 * @return [type] [description]
	 */
    public function keywordTempList()
    {
    	$data = KeywordTemp::all();
    	return view('admin.approve.keyword.all', ['data' => $data]);
    }

    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function keywordApprove(Request $request)
    {
    	// echo $id;
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0': // Add
	    			$keyword = new keyword;
	    			$keyword->value = $data['new_keyword'];
	    			$keyword->status = 1;
	    			break;
	    		case '1': // Edit
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$keyword->value = $data['new_keyword'];
	    			break;
	    		case '2': // Delete
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$keyword->status = 0;
	    			break;	
	    		default:

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
    public function keywordDecline(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0': // Decline Add
	    			// Delete row on wt_keyword table
	    			// Delete meaning on wt_meaning_temp table
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$data->delete();
	    			$keyword->delete();
	    			break;
	    		case '1': // Decline Edit
	    		case '2': // Decline Delete
	    			$data->delete();
	    			break;	
	    		default:

	    			break;
    		}	
    	}
    	return redirect()->route('keywordTempList');
    }

    /**
     * return list request on meaning table
     * @return [type] [description]
     */
    public function meaningTempList()
    {
    	$data = MeaningTemp::all();
    	return view('admin.approve.meaning.list', ['data' => $data]);
    }

    public function meaningApprove(Request $request)
    {
    	$id = $request->id;
    	$opCode = $request->opCode;
    	$data = MeaningTemp::find($id);
    	if ($data != null) {
        	switch ($opCode) {
	    		case '0':
	    			// TODO
	    			break;
	    		case '1': // Edit
	    			$meaning = meaning::find($data['old_meaning_id']);
	    			$meaning->value = $data['new_meaning'];
	    			break;
	    		case '2': // Delete
	    			$meaning = meaning::find($data['old_meaning_id']);
	    			$meaning->status = 0;
	    			break;
	    		default:
	    			
	    			break;
    		}
    		$meaning->save();
	    	$data->delete();
    	}
    	return redirect()->route('meaningTempList');
    }

    public function meaningDecline(Request $request)
    {
    	// TODO
    	echo "decline";
    }
}
