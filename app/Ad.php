<?php

namespace RealEstate;

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
        return $this->hasMany('RealEstate\Comment', 'ad_id');
    }

    public function appointments()
    {
        return $this->hasMany('RealEstate\Appointment', 'ad_id');
    }

    public function images()
    {
        return $this->hasMany('RealEstate\Image', 'ad_id');
    }

    public function hasAdditions()
    {
        return $this->hasMany('RealEstate\HasAddition', 'ad_id');
    }

    public function realEstateType()
    {
        return $this->belongsTo('RealEstate\RealEstateType', 'real_estate_type_id');
    }

    public function apartmentType()
    {
        return $this->belongsTo('RealEstate\ApartmentType', 'apartment_type_id');
    }

    public function floorDescription()
    {
        return $this->belongsTo('RealEstate\FloorDescription', 'floor_desc');
    }

    public function heatingOption()
    {
        return $this->belongsTo('RealEstate\HeatingOption', 'heating_option_id');
    }

    public function parkingOption()
    {
        return $this->belongsTo('RealEstate\ParkingOption', 'parking_option_id');
    }

    public function woodWorkType()
    {
        return $this->belongsTo('RealEstate\WoodworkType', 'woodwork_type_id');
    }

    public function furnitureDescription()
    {
        return $this->belongsTo(FurnitureDescription::class, 'furniture_desc_id');
    }
}
