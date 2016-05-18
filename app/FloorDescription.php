<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class FloorDescription extends Model
{
    public $primaryKey = 'floor_desc';
    public $timestamps = false;
    public $table = 'floor_desc';

    public function ads()
    {
        return $this->hasMany(Ad::class, 'floor_desc');
    }

    public static function helperSelect()
    {
        $types = FloorDescription::all();
        $array = array();
        foreach ($types as $type){
            $array[$type->floor_desc]=$type->description;
        }

        return $array;
    }
}
