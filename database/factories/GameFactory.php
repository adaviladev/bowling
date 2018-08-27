<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'score' => $faker->numberBetween(0, 300),
        'complete' => $faker->boolean,
    ];
});
