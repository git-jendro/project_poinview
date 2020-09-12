<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Song;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Song::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'album_id' => factory(App\Album::class)->create()->id,
        'name' => $faker->name(),
        'genre' => $faker->word(),
        'lyric' => $faker->text(),
        'description' => $faker->text(),
        'song' => $faker->mimeType(),
        'thumbnail' => $faker->imageUrl($width = 500, $height = 500),
        'description' => $faker->sentence(),
        'thumbnail' => $faker->imageUrl($width=500,$height=500),
    ];
});
