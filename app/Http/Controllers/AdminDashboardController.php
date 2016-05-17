<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return 'admin dash';
    }
}
