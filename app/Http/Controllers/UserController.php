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