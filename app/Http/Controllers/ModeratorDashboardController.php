<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Http\Requests;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        $newAdCount = Ad::where("approvement_status","Pending")->get()->count();
        return view('moderator.moddash',compact("newAdCount"));
    }
}
