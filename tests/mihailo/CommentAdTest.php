<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use RealEstate\User;

class CommentAdTest extends TestCase
{
    use DatabaseTransactions;
    public function test_add_comment_on_ad()
    {
        $ad = factory(\RealEstate\Ad::class)->create(['user_id' => 3, 'approvement_status' => 'Approved']);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);
        Auth::attempt([
           'username' => 'korisnik',
            'password' => 'korisnik123'
        ]);
        $this->visit('/ad/'.$ad->ad_id)
            ->type('Neki komentar', 'body')
            ->press('Pošalji Komentar');

        $this->visit('/ad/'.$ad->ad_id)
            ->see('Neki komentar');
    }

    public function test_no_body_in_comment()
    {
        $ad = factory(\RealEstate\Ad::class)->create(['user_id' => 3, 'approvement_status' => 'Approved']);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);
        Auth::attempt([
            'username' => 'korisnik',
            'password' => 'korisnik123'
        ]);
        $this->visit('/ad/'.$ad->ad_id)
            ->press('Pošalji Komentar');
        $this->see('Polje je obavezno.');
    }
}
