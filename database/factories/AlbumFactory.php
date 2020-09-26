<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ramsey\Uuid\Uuid;
use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'user_id' => factory(App\User::class)->create()->id,
        'name' => $faker->name(),
        'slug' => $faker->slug(),
        'description' => $faker->sentence(),
        'thumbnail' => $faker->imageUrl($width=500,$height=500),
    ];
});
