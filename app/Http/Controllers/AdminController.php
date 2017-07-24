<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KeywordTemp;
use App\MeaningTemp;
use App\Users;
use App\keyword;

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
    public function keywordApprove($id, $opCode)
    {
    	// echo $id;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0':
	    			$keyword = new keyword;
	    			$keyword->value = $data['new_keyword'];
	    			$keyword->status = 1;
	    			$keyword->save();
	    			$data->delete();
	    			break;
	    		case '1':
	    			$keyword = keyword::find($data['old_keyword_id']);
	    			$keyword->value = $data['new_keyword'];
	    			$keyword->save();
	    			$data->delete();
	    			break;
	    		case '2':
	    			
	    			break;	
	    		default:

	    			break;
    		}	
    	}
    	
    	return redirect()->back();
    }

    /**
     * Decline request on keyword table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function keywordDecline(Request $request)
    {
    	echo $request->get('id');
    }

    /**
     * return list request on meaning table
     * @return [type] [description]
     */
    public function meaningTempList()
    {
    	$data = MeaningTemp::all();
    	return view('admin.approve.meaning.all', ['data' => $data]);
    }
}
