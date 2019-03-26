<?php
use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        "first_name" => $faker->name,
        "last_name" => $faker->name,
    ];
});
