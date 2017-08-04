<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Validator;

class UserController extends Controller
{
    public function view($id = NULL)
    {
        $user = Sentinel::getUser();
        return view('user.view')->with('user', $user);
    }

    public function edit($id = NULL)
    {
        $user = Sentinel::getUser();
        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|min:6|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'last_name' => 'required|min:6|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
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

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user ->update();
        return redirect('user/edit/'.$id)->with('notification','Edit completed');
    }
}