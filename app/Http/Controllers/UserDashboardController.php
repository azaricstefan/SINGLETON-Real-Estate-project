<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.user.index');
    }
}
