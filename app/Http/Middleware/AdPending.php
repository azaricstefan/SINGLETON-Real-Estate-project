<?php

namespace RealEstate\Http\Middleware;

use Closure;

class AdPending
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
        if ($request->ad->approvement_status == 'Pending'){
            return abort(401);
        }
        return $next($request);
    }
}
