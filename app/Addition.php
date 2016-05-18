<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    public $table = 'addition';
    public $timestamps = false;
    public $primaryKey = 'addition_id';

    public function hasAds()
    {
        return $this->hasMany(HasAddition::class, 'addition_id');
    }
}
