<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class ParkingOption extends Model
{
    public $primaryKey = 'parking_option_id';
    public $table = 'parking_option';
    public $timestamps = false;

    public function ads()
    {
        return $this->hasMany(Ad::class, 'parking_option_id');
    }

    public static function helperSelect()
    {
        $types = ParkingOption::all();
        $array = array();
        foreach ($types as $type){
            $array[$type->parking_option_id]=$type->option_name;
        }

        return $array;
    }
}
