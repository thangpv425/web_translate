<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRegistrationRequest;
use Sentinel;

class RegisterController extends Controller
{
    public function register(){
    	return view('Authentication.register');
    }


    /**
     * [postRegister description]
     * @param  CheckRegistrationRequest $request [description]
     * @return [type]                            [description]
     */
    public function postRegister(CheckRegistrationRequest $request)
    {
		$user = Sentinel::register($request->all(), true);
		$role = Sentinel::findRoleBySlug('user');
    	$role->users()->attach($user);
    	dd($user);
    	// Sentinel::create($request->all());
    }
}
