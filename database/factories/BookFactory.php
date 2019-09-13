<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'title'=>$faker->text,
        'release_date'=>$faker->date(),
        'author_id'=> function()
            {
                 return \App\Author::inRandomOrder()->first()->id;
            }
    ];
});
