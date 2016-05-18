<?php

namespace SingletonApp\Http\Controllers;

use Illuminate\Http\Request;

use SingletonApp\Http\Requests;

class AdminController extends Controller
{
    public function displayModeratorForm()
    {
        return view("admin/new_moderator");
    }
}
