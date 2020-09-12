<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'name' => $faker->name(),
        'status' => $faker->boolean($chanceOfGettingTrue = 50),
    ];
});
