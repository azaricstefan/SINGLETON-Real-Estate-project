<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        return 'mod dash';
    }
}
