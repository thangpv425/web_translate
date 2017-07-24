<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyword;
use App\meaning;


class KeywordListController extends Controller
{
    public function keyWordList(){
    	/*$keyword= keyword::join('wt_meaning','wt_keyword.keyword_id','=','wt_meaning.keyword_id')
    	->selectRaw('wt_keyword.keyword_id as id_,wt_keyword.value as keyword_,wt_meaning.value as meaning_')
    	->get();*/
    	$keyword= meaning::all();
    	return view('admin.keyWordList',['keyword'=>$keyword]);
    }
    public function deleteWord($id){
    	$meaning= meaning::where('meaning_id',$id)->first();
    	//$meaning= meaning::find(3);
    	$meaning->status= 0;
    	$meaning->save();
    	$keyword= meaning::all();
    	return view('admin.keyWordList',['keyword'=>$keyword]);
    }
}

