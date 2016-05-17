<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class HeatingOption extends Model
{
    public $primaryKey = 'heating_option_id';
    public $timestamps = false;
    public $table = 'heating_option';

    public function ads()
    {
        return $this->hasMany(Ad::class, 'heating_option_id');
    }
}
