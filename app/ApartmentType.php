<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class ApartmentType extends Model
{
    public $table = 'apartment_type';
    public $timestamps = false;
    public $primaryKey = 'apartment_type_id';

    public function ads()
    {
        return $this->hasMany('App\Ad', 'apartment_type_id');
    }
}
