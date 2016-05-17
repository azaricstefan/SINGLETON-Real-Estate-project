<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'image';
    public $timestamps = false;
    public $primaryKey = 'iamge_id';

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }
}
