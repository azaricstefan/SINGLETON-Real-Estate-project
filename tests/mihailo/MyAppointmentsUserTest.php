<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MyAppointmentsUserTest extends TestCase
{
    use DatabaseTransactions;
    public function test_my_appointments()
    {
        $ad = factory(\RealEstate\Ad::class)->create(['user_id' => 3, 'approvement_status' => 'Approved']);
        $image = factory(\RealEstate\Image::class)->make();
        $ad->images()->save($image);
        $appointment = factory(\RealEstate\Appointment::class)->create(['user_id' => 3, 'agent_id' => 2, 'ad_id' => $ad->ad_id]);
        Auth::attempt([
            'username' => 'korisnik',
            'password' => 'korisnik123'
        ]);
        $this->visit('/appointments/my_appointments')
            ->see($appointment->ad->getName());
    }
}
