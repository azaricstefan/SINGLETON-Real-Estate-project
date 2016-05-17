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
}
