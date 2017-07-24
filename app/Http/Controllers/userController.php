<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\meaning;
use App\keyword;

class userController extends Controller
{
    public function keywordList(){
    	$meaning = meaning::all();
        $keyword = keyword::all();
    	return view('admin.keyWordList',[
            'meaning'=>$meaning,
            'keyword'=>$keyword
                ]);
    }
    public function get_keywordAdd(){
        return view('admin.keyWordAdd');
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
        $id=$keyword->id;
        
        $meaning = new meaning();
        $meaning->keyword_id = $id;
        $meaning->value = $request->txtMeaning;
        $meaning->index = 1;
        $meaning->status = 1;
        
        $meaning->language = $request->language;
        $meaning->save();
        
        return redirect('admin/keywordList');
    }
    public function get_keywordEdit($keyword_id) {
        echo $keyword_id;
        $keyword = keyword::where('keyword_id',$keyword_id);
        return view('admin.keywordEdit',['keyword'=>$keyword]);
    }
    
    public function post_keywordEdit($keyword_id) {
        
    }
}