<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    public $table = 'password_resets';
    public $primaryKey = 'password_resets_id';
    public $timestamps = false;

    public static function getToken($email)
    {
        $token = PasswordResets::where('email', $email)->first();
        return $token->token;
    }

    public static function makeToken($password)
    {
        return \Crypt::encrypt($password);
    }

    public static function confirmToken($token, $email)
    {
        $pr = PasswordResets::where('email', $email)->first();
        if ($pr != null && $pr->token == $token){
            return true;
        }
        return false;
    }

    /*Pravi token za reset passworda preko maila svim korisnicima koji ga nemaju*/
    public static function createTokensForAllUsers()
    {
        \DB::transaction(function(){
            $users = User::all();
            foreach ($users as $user){
                if(PasswordResets::where('email', $user->email)->first() == null){
                    $pass_reset = new PasswordResets();
                    $pass_reset->email = $user->email;
                    $pass_reset->token = \Crypt::encrypt($user->password);
                    $pass_reset->save();
                }
            } 
        });
    }
}
