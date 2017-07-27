<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckRegistrationRequest;
use Sentinel;

class RegisterController extends Controller
{
    public function registerForm(){
        return view('guest.register');
    }

    /**
     * Register a new user
     * @param  CheckRegistrationRequest $request [validate request]
     * @return [type]                            [description]
     */
    public function register(CheckRegistrationRequest $request)
    {
        $user = Sentinel::register($request->all(), true);
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);
        Sentinel::authenticate($request->all());
        return redirect('user/view/'.$user->id);
    }
}