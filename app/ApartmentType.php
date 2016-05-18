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

    public static function helperSelect()
    {
        $types = ApartmentType::all();
        $array = array();
        foreach ($types as $type){
            $array[$type->apartment_type_id]=$type->type_name;
        }

        return $array;
    }
}
