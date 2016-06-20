<?php

namespace RealEstate\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use RealEstate\Http\Requests;
use RealEstate\Ad;
use RealEstate\Http\Controllers\Controller;

use RealEstate\PasswordResets;
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
            Auth::user()->last_login = Carbon::now()->toDateTimeString();
            Auth::user()->save();
            return redirect()->intended('/');//Ovo sada redi zbog onog redirect->guest().
        }
        flash("Pogresni podaci");
        return redirect('login');
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'fullname' => 'required',
            'username' => 'required|max:20|unique:user',
            'email' => 'required|max:50|unique:user|email',
            'password' => 'required|confirmed|min:6',
        ]);

        \DB::transaction(function() use ($request){
            User::create([
                'username' => $request->username,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefon' => $request->telefon,

            ]);

            $rt = new PasswordResets();
            $rt->email = $request->email;
            $rt->token = PasswordResets::makeToken(Hash::make($request->password));
            $rt->save();
        });
        
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
