<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class RealEstateType extends Model
{
    public $primaryKey = 'real_estate_type_id';
    public $timestamps = false;
    public $table = 'real_estate_type';

    public function ads()
    {
        return $this->hasMany(Ad::class, 'real_estate_type_id');
    }

    public static function helperSelect()
    {
        $types = RealEstateType::all();
        $array = array();
        foreach ($types as $type){
            $array[$type->real_estate_type_id]=$type->type_name;
        }
        
        return $array;
    }
}
