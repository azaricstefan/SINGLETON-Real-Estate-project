<?php

namespace RealEstate;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $primaryKey = 'user_id';
    public $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'fullname', 'email', 'password', 'username', 'user_type_id', 'telefon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function ads(){
        return $this->hasMany(Ad::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function isAdmin()
    {
        //dd($this);
        return ($this->user_type_id == 1) ? true : false;
    }

    public function isModerator()
    {
        return ($this->user_type_id == 2) ? true : false;
    }

    public function isPlebs()
    {
        return ($this->user_type_id == 3) ? true : false;
    }
}
