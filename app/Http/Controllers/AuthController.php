<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SingletonApp\Http\Requests;
use SingletonApp\Ad;
use SingletonApp\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){

            
            return 'Ulogovan si';
        }
        
        return 'Fail, go back to login';
    }
}
