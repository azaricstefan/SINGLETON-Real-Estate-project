<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class HasAddition extends Model
{
    public $timestamps = false;
    public $table = 'has_additions';
    public $primaryKey = 'has_additions_id';

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class, 'addition_id');
    }
}
