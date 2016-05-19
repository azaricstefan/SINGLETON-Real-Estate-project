<?php

namespace RealEstate\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use RealEstate\Ad;

use RealEstate\Appointment;
use RealEstate\Http\Requests;

class AppointmentController extends Controller
{
    public function all7days(Ad $ad)
    {
        $today = Carbon::now();
        //dd($today->toDateTimeString());
        $nextWeek = Carbon::now()->today()->addWeek()->addDay();
        $appointments = Appointment::where('ad_id', $ad->ad_id)->
            where('appointment_time', '>=' ,$today->toDateTimeString())->
            where('appointment_time', '<=', $nextWeek->toDateTimeString())->get();
        $app = array();
        foreach ($appointments as $appointment){
            array_push($app, $appointment->appointment_time);
        }
        return view('appointment.show7days', compact('app', 'ad'));
    }

    public function reserve(Request $request, $ad)
    {
        $exists = Appointment::where('ad_id', $ad)->where('appointment_time', $request->appointment_time)->get();
        if (count($exists) == 0){
            $appointment = new Appointment();
            $appointment->appointment_time = $request->appointment_time;
            $appointment->ad_id = $ad;
            $appointment->user_id = \Auth::user()->user_id;
            $appointment->save();
            return redirect()->back();
        }
        else{
            return 'Termin za taj oglas vec postoji';
        }
    }
}
