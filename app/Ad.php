<?php

namespace SingletonApp;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public $table = 'ad';
    public $timestamps = false;
    public $primaryKey = 'ad_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('SingletonApp\Comment', 'ad_id');
    }

    public function appointments()
    {
        return $this->hasMany('SingletonApp\Appointment', 'ad_id');
    }

    public function images()
    {
        return $this->hasMany('SingletonApp\Image', 'ad_id');
    }

    public function hasAdditions()
    {
        return $this->hasMany('SingletonApp\HasAddition', 'ad_id');
    }

    public function realEstateType()
    {
        return $this->belongsTo('SingletonApp\RealEstateType', 'real_estate_type_id');
    }

    public function apartmentType()
    {
        return $this->belongsTo('SingletonApp\ApartmentType', 'apartment_type_id');
    }

    public function floorDescription()
    {
        return $this->belongsTo('SingletonApp\FloorDescription', 'floor_desc');
    }

    public function heatingOption()
    {
        return $this->belongsTo('SingletonApp\HeatingOption', 'heating_option_id');
    }

    public function parkingOption()
    {
        return $this->belongsTo('SingletonApp\ParkingOption', 'parking_option_id');
    }

    public function woodWorkType()
    {
        return $this->belongsTo('SingletonApp\WoodworkType', 'woodwork_type_id');
    }
}
