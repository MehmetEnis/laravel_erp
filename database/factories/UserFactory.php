<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->unique()->safeEmail,
        "password" => bcrypt('secret'),
        "role_id" => factory('App\Role')->create(),
        "remember_token" => Str::random(10),
    ];
});
