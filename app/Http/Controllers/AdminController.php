<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;
use RealEstate\User;

class AdminController extends Controller
{
    /*prikazuje formu za moderatora*/
    public function displayModeratorForm()
    {
        return view("admin/new_moderator");
    }

    /*stvara novog moderator*/
    public function createModerator(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|max:20|unique:user',
            'email' => 'required|max:30|unique:user|email',
            'password' => 'required|confirmed|min:6',
            'telefon' => 'max:12|digits_between:0,12',
            'fullname' => 'required|min:1'
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->user_type_id = 2;
        $user->password = bcrypt($request->password);
        $user->save();

        flash("Moderator uspesno dodat!");

        return redirect('/dashboard/admin');
    }
}
