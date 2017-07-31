<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Keyword;

class TranslateController extends Controller
{
	/*
	* cac function xu ly tren man hinh dich chinh
	*/

	/**
	* show translate page
	* @return Illuminate\resources\views\user\translate_page
	*/
    public function showPage(){
    	return view('user.translate_page');
    }

    /*
    * show meaning of keyword after user click search
    * return @return Illuminate\resources\views\user\translate_page
    */
    public function search(Request $request){
        define('EXIST',1,true);
        define('NOT_EXIST','* Sorry! this keyword does not exist',true);
        $this->validate($request,['keyword'=>'required|alpha']);
        //search keyword
        $keyword=Keyword::where('keyword',$request->keyword)
        			     ->where('status',EXIST)        
        			     ->first();        
        if($keyword!=null)            
        {
        	$meaning= $keyword->meaning->where('language',$request->language)
                                       ->where('status',EXIST);
        	if(count($meaning)==0) $meaning=NOT_EXIST;
        }     
        else
        	$meaning=NOT_EXIST;        
        return view('user.translate_page',['keyword'=>$keyword,
                                           'result'=>$meaning,
                                           'language'=>$request->language
                                           ]);
    }
}
