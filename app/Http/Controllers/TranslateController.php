<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyword;

class TranslateController extends Controller
{
    public function showPage(){
    	return view('translatePage');
    }
    public function search(Request $request){
    	$r=keyword::where('value',$request->keyword)->first();
    	$result= $r->meaning;
    	//echo $result;
    	//echo $result[0]->value.'<br>'.$result[0]->value;
    	return view('translatePage',['keyword'=>$request->keyword,'result'=>$result]);
    }
}
