<?php

use Faker\Generator as Faker;

$factory->define(App\Organisation::class, function (Faker $faker) {
    $name =  $faker->company;
    return [
        'name' => $name,
        'aims_and_activities' => $faker->bs,
        'email' => $faker->email,
        'telephone' => $faker->phoneNumber,
        'postcode' => $faker->postcode,
        'income_band_id' => $faker->randomDigit(9),
        'order_name' => $name,
        'user_id' => $faker->randomDigit(9),
    ];
});
