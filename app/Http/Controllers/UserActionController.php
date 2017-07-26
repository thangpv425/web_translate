<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\keyword;
use App\meaning;
use App\KeywordTemp;
use App\MeaningTemp;
use Sentinel;


class UserActionController extends Controller
{
    public function get_keywordAdd(){
        return view('admin/keywordAdd');
    }
    public function post_keywordAdd(Request $request){
        $user=Sentinel::getUser();
        $this->validate($request,[
            'txtKeyWord' => 'required|alpha|unique:wt_keyword,value',
            'txtMeaning' => 'required|regex:/^[A-Za-z ]+$/',
            'txtCommment'=> 'alpha'
        ]);
        //add to wt_keyword with status = -1
        $keyword = new keyword();
        $keyword->value = $request->txtKeyWord;
        $keyword->status= -1;
        $keyword->save();
        $id=$keyword->keyword_id;        
        
        $keyword_temp = new KeywordTemp();
        $keyword_temp->opCode = 0;
        $keyword_temp->old_keyword_id = $id;
        $keyword_temp->user_id = $user->id;
        $keyword_temp->new_keyword = $request->txtKeyWord;
        $keyword_temp->comment = $request->txtComment;
        $keyword_temp->save();
        
        $meaning_temp = new MeaningTemp();
        $meaning_temp->opCode = 0;
        $meaning_temp->user_id = $user->id;
        $meaning_temp->keyword_id = $id;
        $meaning_temp->new_meaning = $request->txtMeaning;
        $meaning_temp->index = 1;
        $meaning_temp->language = $request->language;
        $meaning_temp->comment = $request->txtComment;
        $meaning_temp->save();
        return redirect('translate');
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