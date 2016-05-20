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
        $this->validateAd($request);

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
        return redirect('myads');
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
        if ($ad == null){
            abort(504);
        }
        if ($ad->approvement_status == 'Pending') {
            if (!Auth::guest() && Auth::user()->user_id != $ad->user_id && Auth::user()->isPlebs() || Auth::guest())
                abort(401);
        }
        $ad = $this->returnEagerAdd($id);
        return view('ad.show', compact('ad'));
    }

    public function edit($id)
    {
        $ad = $this->returnEagerAdd($id);
        if($ad->checkPermissionToEdit())
            return view('ad.edit', compact('ad'));
        else
            return 'Nije tvoj oglas';
    }

    public function update(Request $request,Ad $id)
    {
        $this->validateAd($request);

        \DB::transaction(function() use($request, $id){
            $currentAdditions = HasAddition::all()->where('ad_id', $id->ad_id);
            $newAdditions = $request->addition_id;
            $forDelete = array();
            $toKeep = array();
            foreach ($currentAdditions as $addition){
                $contains = false;
                foreach ($newAdditions as $newAddition){
                    if($newAddition == $addition->addition_id){
                        $contains = true;
                        break;
                    }
                }
                if (!$contains){
                    array_push($forDelete, $addition->has_additions_id);
                }else{
                    array_push($toKeep, $addition->addition_id);
                }
            }
            HasAddition::destroy($forDelete);

            foreach ($newAdditions as $newAddition){
                if (!in_array($newAddition, $toKeep)){
                    $newHasAddition = new HasAddition();
                    $newHasAddition->ad_id = $id->ad_id;
                    $newHasAddition->addition_id = $newAddition;
                    $newHasAddition->save();
                }
            }
            $id->update($request->all());

        });
        return redirect(url('ad/'.$id->ad_id));
    }

    /**
     * @param Request $request
     */
    private function validateAd(Request $request)
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

    public function delete($ad)
    {
        $ad = Ad::where('ad_id', $ad)->first();
        if($ad == null){
            abort(504);
        }
        if(Auth::user()->user_id == $ad->user_id || !Auth::user()->isPlebs()){
            $ad->delete();
            return redirect('dashboard');
        }
        return abort(401);
    }

    private static function requestArrayToInStatement($requestArray)
    {
        $searchString = array_values($requestArray);
        $searchString = implode(",",$searchString);
        $searchString = "(".$searchString.")";
        return $searchString;
    }
    public function displayAds()
    {
        $ads = Ad::query();
        if(request()->has("ad_type"))$ads = $ads->where("ad_type",request()->ad_type);
        if(request()->has("real_estate_type_id"))$ads = $ads->where("real_estate_type_id", request()->real_estate_type_id);
        if(request()->has("city"))$ads = $ads->where("city", 'like', request()->city."%");
        if(request()->has("municipality"))$ads = $ads->where("municipality", 'like', request()->municipality."%");
        if(request()->has("address"))$ads = $ads->where("address", 'like', "%".request()->address."%");
        if(request()->has("apartment_type_id"))$ads = $ads->where("apartment_type_id", request()->apartment_type_id);
        if(request()->has("floor_desc")){
            $searchString = self::requestArrayToInStatement(request()->floor_desc);
            $ads = $ads->whereRaw("floor_desc IN ".$searchString);
        }
        if(request()->has("price_from"))$ads = $ads->where("price",">=",request()->price_from);
        if(request()->has("price_to"))$ads = $ads->where("price","<=",request()->price_to);
        if(request()->has("area_from"))$ads = $ads->where("floor_area", ">=",request()->area_from);
        if(request()->has("area_to"))$ads = $ads->where("floor_area", "<=" ,request()->area_to);
        if(request()->has("documentation"))$ads = $ads->where("documentation",request()->documentation);
        if(request()->has("heating_option_id"))
        {
            $searchString = self::requestArrayToInStatement(request()->heating_option_id);
            $ads = $ads->whereRaw("heating_option_id IN ".$searchString);
        }
        if(request()->has("addition_id")){
            $searchString = self::requestArrayToInStatement(request()->addition_id);
            $ads = $ads->whereRaw(count(request()->addition_id)." <= (select count(*) from `has_additions` where `has_additions`.`ad_id` = ad.ad_id and addition_id in $searchString)");
        }
        if(request()->has("parking_option_id"))
        {
            $searchString = self::requestArrayToInStatement(request()->parking_option_id);
            $ads = $ads->whereRaw("parking_option_id IN ".$searchString);
        }
        if(request()->has("woodwork_type_id"))
        {
            $searchString = self::requestArrayToInStatement(request()->woodwork_type_id);
            $ads = $ads->whereRaw("woodwork_type_id IN ".$searchString);
        }
        if(request()->has("furniture_desc_id"))
        {
            $searchString = self::requestArrayToInStatement(request()->furniture_desc_id);
            $ads = $ads->whereRaw("furniture_desc_id IN ".$searchString);
        }
        $ads = $ads->paginate(5);
        request()->flash();
        return view('ad.search', compact("ads"));
    }


}

