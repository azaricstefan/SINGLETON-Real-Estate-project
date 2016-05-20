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
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
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
        'user_id' => 3,
        'approvement_status' => 'Approved',
        'note' => $faker->paragraph
    ];
});

$factory->define(RealEstate\Image::class, function (Faker\Generator $faker) {
    return [

        'image_path' => 'http://i.imgur.com/svkcLyz.jpg'

    ];
});