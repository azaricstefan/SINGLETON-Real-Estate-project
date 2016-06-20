<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;
use RealEstate\PasswordResets;
use RealEstate\User;
use Mail;

class PasswordController extends Controller
{
    public function showReset()
    {
        return view('dashboard.password.reset');
    }
    
    public function reset(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if(!\Hash::check($request->old_password, \Auth::user()->password)){
            return back()->withInput()->withErrors(['old_password' => 'old_password']);
        }

        \DB::transaction(function() use ($request){
            \Auth::user()->password = \Hash::make($request->password);
            \Auth::user()->save();

            $rt = PasswordResets::where('email', \Auth::user()->email)->first();
            if ($rt == null){
                $rt = new PasswordResets();
                $rt->token = PasswordResets::makeToken(\Auth::user()->password);
                $rt->email = \Auth::user()->email;
                $rt->save();
            }
            else {
                $rt->token = PasswordResets::makeToken(\Auth::user()->password);
                $rt->save();
            }
        });


        flash('Lozinka uspešno promenjena');
        return redirect('dashboard');
    }

    public function emailResetForm($token, $email)
    {
        if (PasswordResets::confirmToken($token, $email))
            return view('emails.reset');
        abort(504);
    }

    public function resetViaEmail(Request $request)
    {
        if (PasswordResets::confirmToken($request->password_token, $request->email)) {
            \DB::transaction(function () use ($request) {
                $this->validate($request, ['password' => 'required|confirmed|min:6']);
                $user = User::where('email', $request->email)->first();
                $user->password = \Hash::make($request->password);
                $user->save();

                $rt = PasswordResets::where('email', $request->email)->first();
                $rt->token = PasswordResets::makeToken($user->password);
                $rt->save();
            });
            return redirect('/');//neka redirekciaj posle 5 sekundi da se namesti
        }
        return 'ups';
    }

    public function sendEmailForm()
    {
        return view('auth.password.email');
    }

    public function sendEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            $username = $user->username;
            $email = $user->email;
            $rt = PasswordResets::where('email', $email)->first();
            if ($rt == null){
                $rt = new PasswordResets();
                $rt->token = PasswordResets::makeToken($user->password);
                $rt->email = $email;
                $rt->save();
            }
            $rt = PasswordResets::where('email', $email)->first();
            $token = $rt->token;
            Mail::send('emails.password_link' ,compact('email', 'username', 'token'), function ($message) use ($email, $username) {

                $message->from('singleton@najjaci.com', 'Agencija poy ');

                $message->to($email, $username)->subject('Promena lozinke');
                return 'poslato';
            });
            return redirect('/');//opet je pozeljan neki info sa redirekcijom
        }
        return 'nema takog odje';
    }
}
