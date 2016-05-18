<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;

class AdminController extends Controller
{
    public function displayModeratorForm()
    {
        return view("admin/new_moderator");
    }
}
