<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(RealEstate\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'fullname' => $faker->name,
        'telefon' => $faker->phoneNumber,
        'password' => bcrypt('korisnik123'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(RealEstate\User::class, 'moderator', function ($faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'fullname' => $faker->name,
        'telefon' => $faker->phoneNumber,
        'password' => bcrypt('moderator123'),
        'remember_token' => str_random(10),
        'user_type_id' => 2
    ];
});

$factory->define(RealEstate\Ad::class, function (Faker\Generator $faker) {
    return [
        'city' => $faker->city,
        'municipality' => $faker->city,
        'address' => $faker->address,
        'price' => $faker->numberBetween(500,10000),
        'description' => $faker->paragraph,
        'floor_area' => $faker->numberBetween(30,500),
        'num_of_rooms' => $faker->numberBetween(1,20),
        'num_of_bathrooms' => $faker->numberBetween(1,20),
        'construction_year' => $faker->year,
        'note' => $faker->paragraph,
        'ad_type' => $faker->randomElement(['Renting','Selling']),
        'real_estate_type_id' => $faker->numberBetween(1,3),
        'apartment_type_id' => $faker->numberBetween(1,7),
        'floor_desc' => $faker->numberBetween(1,13),
        'heating_option_id' => $faker->numberBetween(1,6),
        'parking_option_id' => $faker->numberBetween(1,5),
        'woodwork_type_id' => $faker->numberBetween(1,5),
        'furniture_desc_id' => $faker->numberBetween(1,4),
        'documentation' => $faker->numberBetween(0, 1),
        'approvement_status' => 'Approved',
        'note' => $faker->paragraph
    ];
});

$factory->define(RealEstate\Image::class, function (Faker\Generator $faker) {
    return [
        'image_path' => $faker->imageUrl(720,480,null,true)
    ];
});

$factory->define(RealEstate\Comment::class, function (Faker\Generator $faker) {
    return [
        'reported' => $faker->biasedNumberBetween(0,1, function($x) { return 1 - sqrt($x); }),
        'body' => $faker->paragraph()
    ];
});

$factory->define(RealEstate\Appointment::class, function (Faker\Generator $faker) {
    return [
        'appointment_time' => $faker->dateTimeBetween("now", "1 month")->setTime($faker->numberBetween(8,20),0,0)->format('Y-m-d H:i:s'),
        'user_note' => $faker->paragraph(),
        'status'=>$faker->randomElement(['Scheduled','Pending'])
    ];
});