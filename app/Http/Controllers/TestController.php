<?php

namespace SingletonApp\Http\Controllers;

use SingletonApp\User;
use SingletonApp\Ad;
use Illuminate\Http\Request;

use SingletonApp\Http\Requests;
use SingletonApp\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        \Auth::loginUsingId(1);
        $user = \Auth::user();
        $user->load("ads.comments");
        return $user;
    }
}
