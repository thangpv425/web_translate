<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\keyword;
use Illuminate\Database\Eloquent\Model;
class TranslateController extends Controller
{
    public function showPage(){
        return view('translatePage');
    }
    public function search(Request $request){
        $this->validate($request,[
            'keyword'=>'required|alpha'
            ],[
            'keyword.required'=>'keyword is required',            
            ]);
        $selected=$request->idLanguage;
        $r=keyword::where('value',$request->keyword)
        ->where('status',1)        
        ->first();        
        if($r!=null)            
        $result= $r->meaning->where('language',$request->idLanguage)->where('status',1);     
        else
        $result='nullVal';        
        return view('translatePage',['keyword'=>$r,'result'=>$result,'selected'=>$selected]);
    }
}