<?php

namespace RealEstate\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use RealEstate\User;
use RealEstate\Http\Requests;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.user.index');
    }

	public function updateProfileForm()
	{
		return view('dashboard.user.updateProfile');
	}


	public function updateProfile(Request $request)
	{

		$this->validate($request,[
			'fullname' => 'required',
			'username' => 'required|max:20',
			'telefon' => 'required',
			'email' => 'required|max:50|email',
		]);

		if( $request->has('fullname') ||
			$request->has('username') ||
			$request->has('telefon') ||
			$request->has('email')
			)
		{

			//nadji korisnika
			$user = User::find(Auth::user()->user_id);

			//izmeni samo unete podatke
			if($request->has('fullname'))
				$user->fullname = $request->fullname;

			if($request->has('username')) {
				$test = User::where('username', $request->username)->first();
				if ($test == null || $test->user_id == $user->user_id)
					$user->username = $request->username;
				else {
					flash('Korisnicko ime vec postoji');
					return back();
				}
			}

			if($request->has('telefon'))
				$user->telefon = $request->telefon;

			if($request->has('email')) {
				$test = User::where('email', $request->email)->first();
				if ($test == null || $test->user_id == $user->user_id) {
					$user->email = $request->email;
				}
				else {
					flash('Email vec postoji');
					return back();
				}
			}

			//sacuvaj sve u bazi i preusmeri na pocetnu
			$user->save();
			flash('Uspešno promenjeni podaci u profilu');
			/*TODO: bolje uraditi redirekciju, kod redirect('dashboard'); se izgubi flash poruka*/
			//TODO: dodati obavestenje(alert) korisniku da je (ne)uspesna izmena
			if (Auth::user()->isPlebs()) return redirect('dashboard/user');
			if (Auth::user()->isModerator()) return redirect('dashboard/moderator');
			if (Auth::user()->isAdmin()) return redirect('dashboard/admin');
		}

		return view('dashboard.user.updateProfile');
	}
}
