<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'age' => $faker->numberBetween(15,100),
        'address'=> $faker->address
    ];
});
