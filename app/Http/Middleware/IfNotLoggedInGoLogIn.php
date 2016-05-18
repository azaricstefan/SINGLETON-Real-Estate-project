<?php

namespace RealEstate\Http\Middleware;

use Closure;
use Auth;

class IfNotLoggedInGoLogIn
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
        if(Auth::guest()){
            return redirect('login');
        }
        return $next($request);
    }
}
