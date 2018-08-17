<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\User::inRandomOrder()
                           ->first()->id;
        },
        'score' => $faker->numberBetween(0, 300)
    ];
});
