<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class RegisterController extends Controller
{
    public function register(){
    	return view('Authentication.register');
    }

    public function postRegister(Request $request)
    {
    		$user = Sentinel::register($request->all(), true);
			$role = Sentinel::findRoleBySlug('user');
	    	$role->users()->attach($user);
	    	dd($user);
	    	// Sentinel::create($request->all());
    }
}
