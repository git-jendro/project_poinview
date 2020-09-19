<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Genre;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Genre::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'name' => $faker->name(),
        'description' => $faker->sentence()
    ];
});
