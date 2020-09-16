<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->toString(),
        'category_id' => factory(App\Category::class)->create()->id,
        'user_id' => factory(App\User::class)->create()->id,
        'slug' => $faker->slug(),
        'heading' => $faker->title(),
        'body' => $faker->text(),
    ];
});
