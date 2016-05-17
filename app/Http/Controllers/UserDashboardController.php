<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;

class UserDashboardController extends Controller
{
    public function index()
    {
        return 'user dash';
    }
}
