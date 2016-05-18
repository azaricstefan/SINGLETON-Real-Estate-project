<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use RealEstate\Http\Requests;
use RealEstate\Ad;
use RealEstate\Http\Controllers\Controller;

use RealEstate\User;
use Hash;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){

            
            return redirect()->intended('/');
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
