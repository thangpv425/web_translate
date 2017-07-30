<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try 
        {
            if(Sentinel::inRole('user'))
                return $next($request);
            else redirect('login')->withError('you have to log in');
        } catch (\Exception $e) {
            return redirect('login')->withError('you are not allowed to access');
        }
    }
}
