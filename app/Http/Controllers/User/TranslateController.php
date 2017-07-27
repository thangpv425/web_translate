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
        $this->validate($request,[
            			'keyword'=>'required|alpha'
        ]);

        $selected=$request->idLanguage;
        $r=Keyword::where('value',$request->keyword)
        			->where('status',1)        
        			->first();        
        if($r!=null)            
        {
        	$result= $r->meaning->where('language',$request->idLanguage)->where('status',1);
        	if(count($result)==0) $result='nullVal';
        }     
        else
        	$result='nullVal';        
        return view('translatePage',['keyword'=>$r,'result'=>$result,'selected'=>$selected]);
    }
}
