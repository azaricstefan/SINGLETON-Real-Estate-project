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
    $imgPaths=[
        0 => 'http://imgur.com/YqS3iUo.jpg',
        1 => 'http://imgur.com/mglFdC1.jpg',
        2 => 'http://imgur.com/Xeg4mx7.jpg',
        3 => 'http://imgur.com/lVQZYA9.jpg',
        4 => 'http://imgur.com/37a9rC5.jpg',
        5 => 'http://imgur.com/NezT4sz.jpg',
        6 => 'http://imgur.com/MCg3Xaz.jpg',
        7 => 'http://imgur.com/YvH2NEx.jpg',
        8 => 'http://imgur.com/984WZ9O.jpg',
        9 => 'http://imgur.com/efR38YK.jpg',
        10 => 'http://imgur.com/vE9uiXz.jpg',
        11 => 'http://imgur.com/6370bjD.jpg',
        12 => 'http://imgur.com/3ajNOtP.jpg',
        13 => 'http://imgur.com/vcfHLWG.jpg',
        14 => 'http://imgur.com/2z3cERv.jpg',
        15 => 'http://imgur.com/mW1X0ni.jpg',
        16 => 'http://imgur.com/wq9TiUN.jpg',
        17 => 'http://imgur.com/22bwBeP.jpg',
        18 => 'http://imgur.com/7zfYDyx.jpg',
        19 => 'http://imgur.com/MCZLAce.jpg',
        20 => 'http://imgur.com/EEVlUWV.jpg'

    ];

    return [
        'image_path' => $imgPaths[array_rand($imgPaths)]
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