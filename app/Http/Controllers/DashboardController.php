<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;
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
