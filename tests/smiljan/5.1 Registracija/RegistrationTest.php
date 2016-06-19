<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use RealEstate\User;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_added_to_database()
    {
        $this->visit('/register')
            ->type("Petar Petrovic", 'fullname')
            ->type('test@test.com', 'email')
            ->type('testuser', 'username')
            ->type('testpass', 'password')
            ->type('testpass', 'password_confirmation')
            ->press('Registracija');

        $this->seePageIs('/');
        $user = User::where('username','testuser')->first();
        $this->assertNotNull($user);
    }

    public function test_username_taken()
    {
        User::create([
            'username' => 'testuser',
            'fullname' => 'Petar Petrovic',
            'email' => 'test@test.com',
            'password' => Hash::make('testpass'),
            'telefon' => '0612345678',
        ]);

        $this->visit('/register')
            ->type("Petar Petrovic", 'fullname')
            ->type('test@test.com', 'email')
            ->type('testuser', 'username')
            ->type('testpass', 'password')
            ->type('testpass', 'password_confirmation')
            ->press('Registracija');

        $this->seePageIs('/register');
        $this->see("Polje username već postoji");
    }
}
