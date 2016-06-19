<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Dodavanje_moderatora_test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;
    public function testDodavanjeModeratora()
    {
        $user = factory(\RealEstate\User::class)->create(["user_type_id" => "1"]);
        $this->actingAs($user);
        $this->visit("admin/add_moderator");
        $this->type("Mile Mitic", "fullname");
        $this->type("1234", "telefon");
        $this->type("milemitic@gmail.com", "email");
        $this->type("Mile", "username");
        $this->type("moderator123", "password");
        $this->type("moderator123", "password_confirmation");
        $this->press("Dodaj moderatora");

        $moderator = \RealEstate\User::where("username","Mile")->first();
        $this->assertNotNull($moderator);
        $this->see("Moderator uspesno dodat!");
    }
    public function testModeratorVecPostoji(){
        $moderator = factory(\RealEstate\User::class)->create(["user_type_id" => "2"]);
        $admin = factory(\RealEstate\User::class)->create(["user_type_id" => "1"]);
        $this->actingAs($admin);
        $this->visit("admin/add_moderator");
        $this->type($moderator->fullname, "fullname");
        $this->type($moderator->telefon, "telefon");
        $this->type($moderator->email, "email");
        $this->type($moderator->username, "username");
        $this->type("moderator123", "password");
        $this->type("moderator123", "password_confirmation");
        $this->press("Dodaj moderatora");

        $brmoderator = \RealEstate\User::where("username", $moderator->username)->get()->count();
        $this->assertEquals($brmoderator,1);
        $this->see("Polje username već postoji.");
    }
}
