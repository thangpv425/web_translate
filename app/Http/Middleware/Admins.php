<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class Admins
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
        // 1. user should be authenticated
        // 2. authenticated user should be an admin
        if (Sentinel::check() && Sentinel::inRole('admin')) {
            return $next($request);    
        } else {
            return redirect('/');
        }
        
    }
}
