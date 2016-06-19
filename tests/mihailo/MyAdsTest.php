<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MyAdsTest extends TestCase
{
    use DatabaseTransactions;
    public function test_my_ads()
    {
        $ad = factory(\RealEstate\Ad::class)->create(['user_id' => 3, 'approvement_status' => 'Approved']);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);
        Auth::attempt([
            'username' => 'korisnik',
            'password' => 'korisnik123'
        ]);
        $this->visit('/myads')
            ->see('<a href="ad/'.$ad->ad_id.'">Pogledaj</a>');
    }
}
