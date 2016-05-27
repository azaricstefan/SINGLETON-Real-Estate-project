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


	public function updateProfile(Request $request)
	{
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

			if($request->has('username'))
				$user->username = $request->username;

			if($request->has('telefon'))
				$user->telefon = $request->telefon;

			if($request->has('email'))
				$user->email = $request->email;

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
