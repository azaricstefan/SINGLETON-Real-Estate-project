<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Ad;
use RealEstate\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        $ads = Ad::where('approvement_status', 'Approved')->orderBy("post_date", "desc")->take(5)->get();
        
        return view("index", compact("ads"));
    }
}
