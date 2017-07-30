<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	/*
	* @todo show all words to admin
	* @return Illuminate\resource\views\admin\keyword_list
	*/
	public function wordList(){   	    	
		$meaning=Meaning::all();
		return view('admin.word_list',['meaning'=>$meaning]);
	}

    /*
    *@todo allow admin to solf delete word 
    */
    public function deleteWord($id){
    	define('DELETED',0);
    	DB::beginTransaction();
    	try {
    		$meaning= meaning::where('id',$id)->first();
    		$meaning->status= DELETED;
    		$meaning->save();
    		DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    	}
    	$meaning= meaning::all();
    	return view('admin.word_list',['meaning'=>$meaning]);
    }
}
