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

/*
 * Punjenje baze dummy podacima:
 * Funkciji se prosledjuje niz [ "tabela" => <broj-redova> ,...]
 * Dostupni kljucevi:
 * user - generise obicne korisnike password za sve accounte je korsinik123
 * moderator generise moderatore password-moderator123
 * ad - generise oglase sa slikama i hasAdditions vezama
 * comment - generise komentare
 * appointment - generise Zakazane i Preuzete termine
 * 
 * Primer funckije: seedDb(['user'=>100, 'moderator'=>10, 'ad'=>50, 'comment'=>150, 'appointment'=>20])
*/
function seedDb(array $tab)
{
    if(array_key_exists("user",$tab))
    {
        $users = factory(\RealEstate\User::class, $tab['user'])->create();
    }

    if(array_key_exists("moderator",$tab))
    {
        $users = factory(\RealEstate\User::class, 'moderator', $tab['moderator'])->create();
    }

    if(array_key_exists("ad",$tab)){
        $ads = factory(\RealEstate\Ad::class, $tab['ad'])->make();
        $users = \RealEstate\User::where("user_type_id", 3)->get();
        foreach($ads as $ad)
        {
            $users[rand(0,$users->count()-1)]->ads()->save($ad);

            $d = range(1,11);
            shuffle($d);
            $n = rand(0,11);

            for ($i=0 ; $i<$n ; $i++){
                $ha = new \RealEstate\hasAddition();
                $ha->ad_id = $ad->ad_id;
                $ha->addition_id = $d[$i];
                $ha->save();
            }

            for ($i=1 ; $i<=rand(3,5) ; $i++){
                $ad->images()->save(factory(\RealEstate\Image::class)->make());
            }
        }
    }

    if(array_key_exists("comment",$tab)){
        $ads = \RealEstate\Ad::where("approvement_status", "Approved")->get();
        $users = \RealEstate\User::where("user_type_id", 3)->get();
        $comments = factory(\RealEstate\Comment::class, $tab['comment'])->make();
        foreach ($comments as $comment){
            $comment->ad_id = $ads->random()->ad_id;
            $comment->user_id = $users->random()->user_id;
            $comment->save();
        }
    }

    if(array_key_exists("appointment", $tab)){
        $ads = \RealEstate\Ad::where("approvement_status", "Approved")->get();
        $users = \RealEstate\User::where("user_type_id", 3)->get();
        $agents = \RealEstate\User::where("user_type_id", 2)->get();
        $appointments = factory(\RealEstate\Appointment::class, $tab['appointment'])->make();
        foreach ($appointments as $appointment){
            $appointment->ad_id = $ads->random()->ad_id;
            $appointment->user_id = $users->random()->user_id;
            if($appointment->status == 'Scheduled'){
                $appointment->agent_id = $agents->random()->user_id;
            }
            $appointment->save();
        }
    }
}