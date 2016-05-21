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
            $appointment->user_note = $request->user_note;
            $appointment->user_id = \Auth::user()->user_id;
            $appointment->save();
            return redirect()->back();
        }
        else{
            return 'Termin za taj oglas vec postoji';
        }
    }


    public function schedule($appointment)
    {
        $checkScheduled = Appointment::where('appointment_id', $appointment)->first();
        if($checkScheduled->agent_id == null){
            $checkScheduled->agent_id = \Auth::user()->user_id;
            $checkScheduled->status = 'Scheduled';
            $checkScheduled->save();
            flash('Termin dodat u moje termine');
            return back();
        }
        return 'termin je vec preuzet';
    }

    public function myAppointments()
    {
        $kude = null;
        if(\Auth::user()->isPlebs()){
            $kude = $this->userAppointments();
        }
        else{
            $kude = $this->moderatorAppointments();
        }
        return $kude;
    }

    private function userAppointments()
    {
        $appointments = Appointment::where('user_id', \Auth::user()->user_id)
            ->where(function ($query){
            $query->where('status', 'Pending')
            ->orWhere('status', 'Scheduled');
            })
            ->get()->load('ad');
        $appointments = $appointments->sortBy('appointment_time');
        $modDash = getModDash();
        return view('appointment.my', compact('appointments', 'modDash'));
    }

    private function moderatorAppointments()
    {
        $appointments = $this->getModeratorAppointments();
        return view('appointment.my', compact('appointments'));
    }

    public function finish($appointment)
    {
        $appointment = Appointment::where('appointment_id', $appointment)->first();
        if($appointment != null && $appointment->agent_id == \Auth::user()->user_id){
            return view('appointment.finish', compact('appointment'));
        }
        return abort(504);
    }

    public function complete(Request $request, $appointment)
    {
        $appointment = Appointment::where('appointment_id', $appointment)->first();
        if ($appointment == null){
            return abort(504);
        }
        if($appointment->agent_id == \Auth::user()->user_id){//dodati da admin moze da zavrsava sve termine
            $appointment->status = 'Completed';
            $appointment->agent_note = $request->agent_note;
            $appointment->save();
            flash('Termin '.$appointment->ad->city.' '.$appointment->ad->address.' '.$appointment->appointment_time.' zavrsen');
            return redirect('appointments/my_appointments');
        }
        return abort(401);
    }

    public function cancel($appointment)
    {
        $appointment = Appointment::where('appointment_id', $appointment)->first();
        if ($appointment == null){
            return abort(504);
        }
        $kude = null;
        if(\Auth::user()->isPlebs()){
            $kude = $this->userCancel($appointment);
        }
        else{
            $kude = $this->moderatorCancel($appointment);
        }
        return $kude;
    }

    private function moderatorCancel(Appointment $appointment)
    {
        if($appointment->agent_id == \Auth::user()->user_id) {//dodati da admin moze da zavrsava sve termine
            $appointment->status = 'Pending';
            $appointment->agent_id = null;
            $appointment->save();
            flash('Termin '.$appointment->ad->city.' '.$appointment->ad->address.' '.$appointment->appointment_time.' otkazan');
            return redirect('/appointments/my_appointments');
        }
        return abort(401);
    }

    private function userCancel(Appointment $appointment)
    {
        if(\Auth::user()->user_id == $appointment->user_id){
            flash('Termin '.$appointment->ad->city.' '.$appointment->ad->address.' '.$appointment->appointment_time.' otkazan');
            $appointment->delete();
            return back();
        }
        return abort(401);
    }

    /**
     * @return mixed
     */
    private function getModeratorAppointments()
    {
        $appointments = Appointment::where('agent_id', \Auth::user()->user_id)->where('status', 'Scheduled')->get()->load('ad');
        $appointments = $appointments->sortBy('appointment_time');
        return $appointments;
    }
}
