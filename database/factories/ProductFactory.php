<?php
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        "product_name" => $faker->name,
        "product_price" => $faker->randomNumber(2),
    ];
});
