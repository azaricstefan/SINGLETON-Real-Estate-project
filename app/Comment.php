<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $primaryKey = 'comment_id';
    public $timestamps = false;
    public $table = 'comment';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
