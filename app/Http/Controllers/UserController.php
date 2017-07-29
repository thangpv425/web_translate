<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\meaning;
use App\keyword;
use App\Users;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;

class UserController extends Controller
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

    public function view($id = NULL)
    {
        $user = Sentinel::getUser();
        return view('users.view')->with('user', $user);
    }

    public function edit($id = NULL)
    {
        $user = Sentinel::getUser();
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|min:1|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'last_name' => 'required|min:1|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
            ],
            [
                'first_name.required'=>'Please enter first name',
                'last_name.required'=>'Please enter last name',
                'first_name.min'=>'The length of first name is bigger than 1',
                'last_name.min'=>'The length of last name is bigger than 1',
                'first_name.regex'=>'Only accept lowercase or uppercase letters',
                'last_name.regex'=>'Only accept lowercase or uppercase letters'
            ]);

        if ($validator->fails()) {
            return redirect('user/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = Users::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user ->update();
        return redirect('user/edit/'.$id)->with('notification','Edit completed');
    }
}