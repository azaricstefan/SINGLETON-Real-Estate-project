<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Appointment;
use RealEstate\Comment;
use RealEstate\Http\Requests;
use RealEstate\User;

class ModeratorController extends Controller
{
    public function displayNewAds()
    {
        $newAds = Ad::where("approvement_status","Pending")->get();
        $modDash = getModDash();
        return view('moderator.newads', compact('newAds', 'modDash'));
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

    public function displayReported()
    {
        $reported = Comment::where("reported",1)->get();
        $reported = $reported->load("ad","user");
        $modDash = getModDash();
        return view('comment.reported',  compact("reported", "modDash"));
    }


    public function displayPendingAppointments()
    {
        $pendingAppointments = Appointment::where('status', 'Pending')->get()->load('ad');
        $modDash = getModDash();
        return view('appointment.pending', compact('pendingAppointments', 'modDash'));
    }
    

    public function displayUsers()
    {
        if(!empty(request()->criteria) && !empty(request()->searchString)){
            $criteria = request()->criteria;
            $searchString = request()->searchString;
            $users = User::where($criteria, "LIKE", "%$searchString%")->where("user_type_id",3)->get();
        }
        else $users = User::where("user_type_id",3)->get();
        $modDash = getModDash();
        return view("moderator.users_search", compact("users", "modDash"));
    }

    public function displayUserInfo(User $user)
    {
        $user->load("ads");
        return view("moderator.user_info", compact("user"));
    }
    
}
