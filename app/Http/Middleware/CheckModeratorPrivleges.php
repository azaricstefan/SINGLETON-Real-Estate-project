<?php

namespace RealEstate\Http\Middleware;

use Closure;
use Auth;

class CheckModeratorPrivleges
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

        if (Auth::guest() || Auth::user()->isPlebs()) {
            abort(401);
        }
        return $next($request);
    }
}
