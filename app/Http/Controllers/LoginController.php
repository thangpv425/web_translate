<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLoginRequest;
use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function login(Request $Request)	
    {	
    	return view('Authentication.login');
    }

    public function postLogin(CheckLoginRequest $request)	
    {
        try {
            if (Sentinel::authenticate($request->all())) {
                # code...
                return redirect('home');
            } else {
                $err = "Wrong email or password!";
            }
        } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
            // $delay = $e->getDelay();
            $err = "Try again after ".$e->getDelay()." second.";
        }
    	return redirect()->back()->withInput()->with('err', $err);

    }

    public function logout(Request $request)
    {
    	Sentinel::logout();
    	return redirect('/login');
    }

    
}
