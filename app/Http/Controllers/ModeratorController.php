<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Http\Requests;

class ModeratorController extends Controller
{
    public function displayNewAds()
    {
        $newAds = Ad::where("approvement_status","Pending")->get();
        return view('moderator.newads', compact('newAds'));
    }

    public function approveAd(Ad $ad)
    {
        $ad->approvement_status = "Approved";
        $ad->save();
        return redirect('/moderator/new_ads');
    }

    public function denyAd(Ad $ad)
    {
        $ad->approvement_status = "Denied";
        $ad->save();
        return redirect('/moderator/new_ads');
    }
}
