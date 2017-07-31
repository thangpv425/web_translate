<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Closure;
use Sentinel;

class CheckLogin
{
    /**
     * Kiem tra xem nguoi dung da dang nhap chua
     */
    public function handle($request, Closure $next)
    {
        try{
            if(Sentinel::check())
            {
                return $next($request);
            }
            return Redirect::to('login')->withError('You have to log in!');
        }catch(\Exception $e){
            return Redirect::to('login')->withError('You are not allowed to access!');
        }
    }
}
