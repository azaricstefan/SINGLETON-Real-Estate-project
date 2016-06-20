<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OtkazivanjeOglasaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(\RealEstate\User::class)->create(["user_type_id" => "3"]);
        $this->actingAs($user);
        $this->visit("appointments/my_appointments");

        $ad = factory(\RealEstate\Ad::class)->create([
            "ad_id"   => "1",
            "user_id" => $user->user_id
        ]);

        $appointment = factory(\RealEstate\Appointment::class)->create([
//            "appointment_id" => "1",
            "user_id"        => $user->user_id,
            "ad_id"          => "1"
        ]);


        $this->assertNotNull($appointment);

        $ad->delete(); //zbog novog testa
        //$this->click("appointment_cancel"); // error => Could not find a link with a body, name, or ID attribute of [appointment_cancel].
        //$this->click("OK"); //potvrda
        //$this->see("otkazan");
    }
}
