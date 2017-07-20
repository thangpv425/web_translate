<?php

namespace App\Http\Middleware;

use Closure;

class Visitors
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
        if (Sentinel::guest()) {
            return $next($request);
        } else {
            return redirect('/user');
        }
        
    }
}
