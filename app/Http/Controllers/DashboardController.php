<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;
use Auth;
use Redirect;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('ifNotLoggedInGoLogIn');
    }

    public function selectDashboard()
    {
        if(session()->has('flash_message')){
            flash(session('flash_message'));
        }
        if(Auth::user()->isAdmin()){
            return redirect()->action('AdminDashboardController@index');
        }
        
        if(Auth::user()->isModerator()){
            return redirect()->action('ModeratorDashboardController@index');
        }
        
        if(Auth::user()->isPlebs()){
            return Redirect::action('UserDashboardController@index');
        }
    }
}
