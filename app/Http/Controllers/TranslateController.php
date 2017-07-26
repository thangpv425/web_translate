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
        //echo $r;
        if($r!=null)
            
        $result= $r->meaning->where('language',$request->idLanguage)->where('status',1);
     //echo count($result);
    //echo $result;
    /*foreach($result as $r)
        echo $r.'<br>';*/
    //.'<br>'.$result->value;
    //echo $result[0]->1->value;
        else
        $result='nullVal';
        //echo count($result);
        //echo $result;
        //echo $result[0]->value.'<br>'.$result[0]->value;
        return view('translatePage',['keyword'=>$request->keyword,'result'=>$result,'selected'=>$selected]);
    }
}