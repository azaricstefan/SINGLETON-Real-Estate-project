<?php
/**
 * Created by PhpStorm.
 * User: Smiljan
 * Date: 19-Jun-16
 * Time: 7:26 PM
 */


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use RealEstate\User;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    public function test_search_succesful()
    {
        $ad = factory(\RealEstate\Ad::class)->create(["user_id"=>3, "approvement_status"=>"Approved"]);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);

        $this->visit('search')
            ->type($ad->city,'city')
            ->press('Pretraži');

        $this->see($ad->getName());
    }

    public function test_search_unsuccesfull()
    {
        $ad = factory(\RealEstate\Ad::class)->create(["user_id"=>3, "approvement_status"=>"Approved"]);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);

        $this->visit('search')
            ->type('testcity','city')
            ->press('Pretraži');

        $this->dontSee($ad->getName());
    }
}
