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
        $modDash = getModDash();
        return view('moderator.moddash',compact('modDash'));
    }
}
