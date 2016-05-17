<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use SingletonApp\Http\Requests;
use SingletonApp\Ad;
use SingletonApp\Http\Controllers\Controller;

use SingletonApp\User;
use Hash;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){

            
            return redirect('/');
        }
        
        return redirect('login');
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|max:20|unique:user',
            'email' => 'required|max:30|unique:user|email',
            'password' => 'required|confirmed|min:6',
            'telefon' => 'max:12|digits_between:0,12',
        ]);

        User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefon' => $request->telefon,
            
        ]);
        
        return redirect('/');
    }

    public function openLogin()
    {
        return view('auth.login');
    }

    public function openRegister()
    {
        return view('auth.register');
    }
}
