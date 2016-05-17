<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('ifNotLoggedInGoLogIn');
    }

    public function index()
    {
        return view('home');
    }
}
