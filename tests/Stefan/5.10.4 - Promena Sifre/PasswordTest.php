<?php

/**
 * Created by PhpStorm.
 * User: Stefan Azarić
 * Date: 20-Jun-16
 * Time: 10:40
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class PasswordTest extends TestCase
{
	use DatabaseTransactions;

	public function testChangePassword()
	{
		$user = factory(\RealEstate\User::class)->create(["user_type_id" => "1"]);
		$this->actingAs($user);
		$this->visit("password/reset");

		$this->type("korisnik123", "old_password");
		$this->type("NovaSifra", "password");
		$this->type("NovaSifra", "password_confirmation");

		$this->press("Promeni");

		$this->assertTrue(hash::check("NovaSifra", $user->password));
		$this->see("Lozinka uspešno promenjena");
	}



}
