<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class WoodworkType extends Model
{
    public $timestamps = false;
    public $table = 'woodwork_type';
    public $primaryKey = 'woodwork_type_id';

    public function ads()
    {
        return $this->hasMany(Ad::class, 'woodwork_type_id');
    }
}
