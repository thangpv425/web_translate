<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    /**
     * create login form
     * @param  Request $Request [description]
     * @return [type]           [description]
     */
    public function loginForm() 
    {   
        return view('guest.login');
    }

    /**
     * validate request and authenticate user
     * @param  CheckLoginRequest $request [description]
     * @return redirect                     [description]
     */
    public function login(CheckLoginRequest $request)   
    {
        try {
            if (Sentinel::authenticate($request->all())) {
                return redirect('home');
            } else {
                $err = "Wrong email or password!";
            }
        } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
            $err = "Try again after ".$e->getDelay()." second.";
        }
        return redirect()->back()->withInput()->with('err', $err);

    }

    /**
     * logout current user
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        Sentinel::logout();
        return redirect('/login');
    }
}