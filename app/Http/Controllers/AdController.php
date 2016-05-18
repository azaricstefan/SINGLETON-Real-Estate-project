<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\HasAddition;
use RealEstate\Http\Requests;
use RealEstate\Ad;
use Auth;

class AdController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->documentation);

        $ad = new Ad();
        $ad->city = $request->city;
        $ad->municipality = $request->municipality;
        $ad->address = $request->address;
        $ad->ad_type = $request->ad_type;
        $ad->real_estate_type_id = $request->real_estate_type_id;
        $ad->apartment_type_id = $request->apartment_type_id;
        $ad->floor_desc = $request->floor_desc;
        $ad->price = $request->price;
        $ad->description = $request->description;
        $ad->floor_area = $request->floor_area;
        $ad->num_of_rooms = $request->num_of_rooms;
        $ad->num_of_bathrooms = $request->num_of_bathrooms;
        $ad->construction_year = $request->construction_year;
        $ad->documentation = $request->documentation;
        $ad->heating_option_id = $request->heating_option_id;
        $ad->parking_option_id = $request->parking_option_id;
        $ad->user_id = \Auth::user()->user_id;
        $ad->woodwork_type_id = $request->woodwork_type_id;
        $ad->note = $request->note;
        $ad->approvement_status = 'Pending';
        $ad->furniture_desc_id = $request->furniture_desc_id;
        //return $ad;
        \DB::transaction(function() use ($request, $ad){
            $ad->save();
            if (isset($request->addition_id)) {
                foreach ($request->addition_id as $addition) {
                    $has_addition = new HasAddition();
                    $has_addition->ad_id = $ad->ad_id;
                    $has_addition->addition_id = $addition;
                    $has_addition->save();
                }
            }
        });


        /*Ad::create([
           'city' =>  $request->city,
            'municipality' => $request->municipality,
            'address' => $request->address,
            'ad_type' => $request->ad_type,
            'real_estate_type_id' => $request->real_estate_type_id,
            'apartment_type_id' => $request->apartment_type_id,
            'floor_desc' => $request->floor_desc,
            'price' => $request->price,
            'description' => $request->description,
            'floor_area' => $request->floor_area,
            'num_of_rooms' => $request->num_of_rooms,
            'num_of_bathrooms' => $request->num_of_bathrooms,
            'construction_year' => $request->construction_year,
            'documentation' => $request->documentation,
            'heating_option_id' => $request->heating_option_id,
            'parking_option_id' => $request->parking_option_id,
            'user_id' => \Auth::user()->user_id,
            'woodwork_type_id' => $request->woodwork_type_id,
            'note' => $request->note,
            'approvement_status' => 'Pending',
        ]);*/
    }
}
