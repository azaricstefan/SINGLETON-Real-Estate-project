<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Appointment;
use RealEstate\Comment;
use RealEstate\Http\Requests;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        return view('moderator.moddash');
    }
}
