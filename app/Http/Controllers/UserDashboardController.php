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
	    return 'user dash';
    }


	public function updateProfile(Request $request)
	{
		if ($request->has('fullname') ||
			$request->has('username') ||
			$request->has('telefon') ||
			$request->has('email')
			)
		{

			//nadji korisnika
			$user = User::find(Auth::user()->user_id);

			//izmeni podatke
			$user->fullname = $request->fullname;
			$user->username = $request->username;
			$user->telefon = $request->telefon;
			$user->email = $request->email;

			//sacuvaj sve u bazi
			$user->save();
		}
			return view('user.updateProfile'); //TODO: u jednom slucaju treba redirect u drugom samo da prikaze
	}
    //TODO: @Stefan => Azuriranje I Pregled kontakt podataka od strane obicnog korisnika
}
