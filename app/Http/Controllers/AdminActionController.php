<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyword;
use App\meaning;


class AdminActionController extends Controller
{
    public function get_keywordAdd(){
        return view('admin.keywordAdd');
    }
    public function post_keywordAdd(Request $request){
        
        $this->validate($request,[
            'txtKeyWord' => 'required|alpha|unique:wt_keyword,value',
            'txtMeaning' => 'required|alpha'
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
    
    public function get_keywordEdit($id) {
        $keyword = keyword::where('keyword_id',$id)->first();
        $meaning = meaning::where('keyword_id',$id)->get()->first();
        return view('admin.keywordEdit',['keyword'=>$keyword,'meaning'=>$meaning]);
    }
    
    public function post_keywordEdit(Request $request) {
        
        $id=$request->keyword_id;
        
        $this->validate($request,[
            'txtKeyWord' => 'required|alpha',
            'txtMeaning' => 'required|alpha'
        ]);
        
        $keyword = keyword::find($id);
        $keyword->value = $request->txtKeyWord;
        $keyword->status= 1;
        $keyword->save();
        
        $meaning = $keyword->meaning['0'];//meaning::where('keyword_id',$id)->get()->first();
        $meaning->value = $request->txtMeaning;
        $meaning->index = 1;
        $meaning->status = 1;
        $meaning->language = $request->language;
        $meaning->save();
        return redirect('admin/keywordList');
    }
}