<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public $primaryKey = 'user_type_id';
    public $timestamps = false;
    public $table = 'user_type';

    public function user()
    {
        return $this->hasMany(User::class, 'user_type_id');
    }
}
