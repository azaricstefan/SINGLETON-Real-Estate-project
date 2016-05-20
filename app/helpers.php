<?php
/*globalne helper funckije*/


/*U sesiju ubacuje poruku o uspesnosti/gresci poruka traje samo jedan request
*/
function flash($message, $level="info")
{
    session()->flash('flash_message', $message);
    session()->flash('flash_message_level', $level);
}

/*Dohvata se niz podataka za moderator dashboard*/

function getModDash(){
    $newAdCount = RealEstate\Ad::where("approvement_status","Pending")->get()->count();
    $reportedCommentCount = RealEstate\Comment::where("reported",1)->get()->count();
    $newAppointmentCount = RealEstate\Appointment::where('status', "Pending")->get()->count();
    $myAppointmentCount = RealEstate\Appointment::where('agent_id', \Auth::user()->user_id)->where('status', 'Scheduled')->get()->count();
    $modDashCol = collect([
        'newAdCount' => $newAdCount,
        'reportedCommentCount' => $reportedCommentCount,
        'newAppointmentCount' => $newAppointmentCount,
        'myAppointmentCount' => $myAppointmentCount,
    ]);
    return $modDashCol;
}
