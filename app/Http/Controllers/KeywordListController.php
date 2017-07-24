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
    
    public function get_keywordAdd(){
        return view('admin.keywordAdd');
    }
    public function post_keywordAdd(Request $request){
        
        $this->validate($request,[
            'txtKeyWord' => 'required|string|unique:wt_keyword,value'
        ],[
            'txtKeyWord.unique'=>'This keyword existed',
            'txtKeyWord.required'=>'keyword Require!',
            'txtKeyWord.string'=>'Must be string'
        ]);
        $keyword = new keyword();
        $keyword->value = $request->txtKeyWord;
        $keyword->status= 1;
        $keyword->save();
        $id=$keyword->keyword_id;
        
        $meaning = new meaning();
        $meaning->keyword_id = $id;
        $meaning->value = $request->txtMeaning;
        $meaning->index = 1;
        $meaning->status = 1;
        
        $meaning->language = $request->language;
        $meaning->save();
        
        return redirect('admin/keywordList');
    }

}

