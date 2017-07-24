<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KeywordTemp;
use App\MeaningTemp;
use App\Users;

class AdminController extends Controller
{
    public function keywordTempList()
    {
    	$data = KeywordTemp::all();
    	return view('admin.approve.keyword.all', ['data' => $data]);
    }

    public function keywordApprove($id, $opCode)
    {
    	// echo $id;
    	$data = KeywordTemp::find($id);
    	if($data != null){
    		switch ($opCode) {
	    		case '0':
	    			echo "adding";

	    			break;
	    		case '1':
	    			echo "editing";
	    			break;
	    		case '2':
	    			echo "deleting";;
	    			break;	
	    		default:

	    			break;
    		}	
    	}
    	
    	return redirect()->back();
    }

    public function keywordDecline(Request $request)
    {
    	echo $request->get('id');
    }

    public function meaningTempList()
    {
    	$data = MeaningTemp::all();
    	return view('admin.approve.meaning.all', ['data' => $data]);
    }
}
