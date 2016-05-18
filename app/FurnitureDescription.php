<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class FurnitureDescription extends Model
{
    public $timestamps = false;
    public $table = 'furniture_desc';
    public $primaryKey = 'furniture_desc_id';

    public function ads()
    {
        return $this->hasMany(Ad::class, 'furniture_desc_id');
    }

    public static function helperSelect()
    {
        $types = FurnitureDescription::all();
        $array = array();
        foreach ($types as $type){
            $array[$type->furniture_desc_id]=$type->description;
        }

        return $array;
    }
}
