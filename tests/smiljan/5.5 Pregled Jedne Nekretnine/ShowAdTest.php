<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowAdTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function test_ad_showing_correctly()
    {
        $ad = factory(\RealEstate\Ad::class)->create(["user_id"=>3, "approvement_status"=>"Approved"]);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);
        $this->visit("ad/".$ad->ad_id);
        $this->see($ad->city);
        $this->see($ad->municipality);
        $this->see($ad->address);
        $this->see($ad->realEstateType->type_name);
        $this->see($ad->apartmentType->type_name);
        $this->see($ad->floorDescription->description);
    }
}
