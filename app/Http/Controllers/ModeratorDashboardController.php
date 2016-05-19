<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Comment;
use RealEstate\Http\Requests;

class ModeratorDashboardController extends Controller
{
    public function index()
    {
        $newAdCount = Ad::where("approvement_status","Pending")->get()->count();
        $reportedCommentCount = Comment::where("reported",1)->get()->count();
        return view('moderator.moddash',compact("newAdCount","reportedCommentCount"));
    }
}
