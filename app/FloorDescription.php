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
}
