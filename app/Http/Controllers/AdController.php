<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Addition;
use RealEstate\HasAddition;
use RealEstate\Http\Requests;
use RealEstate\Ad;
use Auth;

class AdController extends Controller
{
    public function create(Request $request)
    {
        $this->validetAd($request);

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
    }

    private function returnCurrentUserAds()
    {
        $myads = Ad::all()->where('user_id', Auth::user()->user_id)->load('realEstateType' ,
            'hasAdditions.addition' ,'apartmentType',
            'floorDescription', 'heatingOption',
            'parkingOption', 'woodWorkType',
            'furnitureDescription'
        );
        return $myads;
    }

    public function myAds()
    {
        $myads = $this->returnCurrentUserAds();
        return view('dashboard.user.myads', compact('myads'));
    }

    private function returnEagerAdd($id)
    {
        return Ad::find($id)->load('realEstateType' ,
            'hasAdditions.addition' ,'apartmentType',
            'floorDescription', 'heatingOption',
            'parkingOption', 'woodWorkType',
            'furnitureDescription'
        );
    }

    public function show($id)
    {
        $ad = Ad::find($id);
        if ($ad == null) {
            return 'greska';
        }

        $ad = $this->returnEagerAdd($id);


        return view('ad.show', compact('ad'));
    }

    public function edit($id)
    {
        $ad = $this->returnEagerAdd($id);
        if(Auth::user()->user_id == $ad->user_id || Auth::user()->isAdmin() || Auth::user()->isModerator())
            return view('ad.edit', compact('ad'));
        else
            return 'Nije tvoj oglas';
    }

    public function update(Request $request,Ad $id)
    {
       // return $request->all();
        $this->validetAd($request);
        \DB::transaction(function() use($request, $id){
            $additions = $id->hasAdditions;

            foreach ($additions as $addition){
                $addition->delete();
            }

            $newAdditions = $request->addition_id;
            if ($newAdditions != null) {
                foreach ($newAdditions as $newAddition) {
                    $newHasAddition = new HasAddition();
                    $newHasAddition->ad_id = $id->ad_id;
                    $newHasAddition->addition_id = $newAddition;
                    $newHasAddition->save();
                }
            }
            $id->update($request->all());
        });
        return redirect('myads');
    }

    /**
     * @param Request $request
     */
    private function validetAd(Request $request)
    {
        $this->validate($request, [
            'city' => 'required|max:40',
            'municipality' => 'required|max:40',
            'address' => 'required|max:80',
            'price' => 'required',
            'description' => 'max:300',
            'floor_area' => 'required',
            'num_of_rooms' => 'required',
            'num_of_bathrooms' => 'required',
            'construction_year' => 'required',
            'note' => 'max:300',
        ]);
    }
}
