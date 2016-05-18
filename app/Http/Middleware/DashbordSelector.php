<?php

namespace RealEstate\Http\Middleware;

use Closure;

class DashbordSelector
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
        $str = explode("/",$request->path())[1];
        $arr=["1" => "admin" , "2" => "moderator", "3" => "user"];

        if($arr[\Auth::user()->user_type_id] != $str )
        {
            return redirect("/dashboard");
        }
        return $next($request);
    }
}
