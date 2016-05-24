<?php

namespace RealEstate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Image extends Model
{
    public $table = 'image';
    public $timestamps = false;
    public $primaryKey = 'image_id';

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id');
    }

    //Brisanje slike iz foldera slika
    public function deleteMyStorage()
    {
        if(starts_with($this->image_path,"/storage/ad_images/"))
        {
            File::delete(public_path($this->image_path));
        }
    }

}
