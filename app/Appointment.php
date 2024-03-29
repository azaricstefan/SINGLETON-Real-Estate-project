<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $table = 'appointment';
    public $timestamps = false;
    public $primaryKey = 'appointment_id';

    public function moderator()
    {
        return $this->belongsTo('RealEstate\User', 'agent_id');
    }

    public function user()
    {
        return $this->belongsTo('RealEstate\User', 'user_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
