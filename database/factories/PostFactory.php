<?php

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'post' => $faker->text(140),
    ];
});
