<?php

/**
 * Created by PhpStorm.
 * User: Smiljan
 * Date: 19-Jun-16
 * Time: 2:36 PM
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use RealEstate\User;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_authorization_successful()
    {
        $user = User::create([
            'username' => 'testuser',
            'fullname' => 'Petar Petrovic',
            'email' => 'test@test.com',
            'password' => Hash::make('testpass'),
            'telefon' => '0612345678',
        ]);

        $this->visit("login")
            ->type("testuser","username")
            ->type("testpass","password")
            ->press("Login");

        $this->assertTrue(Auth::check());
        $this->assertEquals($user->user_id, Auth::user()->user_id);
    }
}
