<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function login(Request $Request)	
    {	
    	return view('Authentication.login');
    }

    public function postLogin(Request $request)	
    {
    	Sentinel::authenticate($request->all());
    	return Sentinel::check();
    }

    public function logout(Request $request)
    {
    	Sentinel::logout();
    	return redirect('/login');
    }
}
