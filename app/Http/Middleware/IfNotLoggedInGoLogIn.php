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
            return redirect()->guest('login');//Saljem ga na login zajedno sa URL-om do autorizovane stranice
        }
        return $next($request);
    }
}
