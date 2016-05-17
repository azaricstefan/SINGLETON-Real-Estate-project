<?php

namespace SingletonApp\Http\Middleware;

use Closure;
use Auth;

class CheckIfAdmin
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

        if (!Auth::guest() && Auth::user()->isAdmin()) {
            return $next($request);
        }
        //return redirect('/');
        return 'Nisi admin tebra';
    }
}
