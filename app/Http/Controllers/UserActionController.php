<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyword;
use App\meaning;
use App\keyword_temp;


class UserActionController extends Controller
{
    public function get_keywordAdd(){
        return view('admin.keywordAdd');
    }
    public function post_keywordAdd(Request $request){
        
//        $this->validate($request,[
//            'txtKeyWord' => 'required|string|unique:wt_keyword,value'
//        ],[
//            'txtKeyWord.unique'=>'This keyword existed',
//            'txtKeyWord.required'=>'keyword Require!',
//            'txtKeyWord.string'=>'Must be string'
//        ]);
//        
//        $keyword_temp = new keyword_temp();
//        $keyword_temp->opCode = 0;  
//        $keyword_temp->user_id = 1;
//        $keyword_temp->old_keyword_id = -1;
//        $keyword_temp->new_keyword = $request->txtKeyWord;
//        dd($keyword_temp);
        //$keyword_temp->save();
        //$id=$keyword->keyword_id;
//        
//        $meaning = new meaning();
//        $meaning->keyword_id = $id;
//        $meaning->value = $request->txtMeaning;
//        $meaning->index = 1;
//        $meaning->status = 1;
//        
//        $meaning->language = $request->language;
//        $meaning->save();
//        
//        return redirect('admin/keywordList');
    }
    
    public function get_keywordEdit($id) {
//        $keyword = keyword::where('keyword_id',$id)->first();
//        $meaning = meaning::where('keyword_id',$id)->get()->first();
//        return view('admin.keywordEdit',['keyword'=>$keyword,'meaning'=>$meaning]);
    }
    
    public function post_keywordEdit(Request $request) {
        
//        $id=$request->keyword_id;
//        
//        $this->validate($request,[
//            'txtKeyWord,txtMeaning' => 'required|string'
//        ]);
//        
//        $keyword = keyword::find($id);
//        $keyword->value = $request->txtKeyWord;
//        $keyword->status= 1;
//        $keyword->save();
//        
//        $meaning = meaning::where('keyword_id',$id)->get()->first();
//        $meaning->value = $request->txtMeaning;
//        $meaning->index = 1;
//        $meaning->status = 1;
//        $meaning->language = $request->language;
//        $meaning->save();
//        return redirect('admin/keywordList');
    }
}