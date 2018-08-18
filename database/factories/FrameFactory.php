<?php

use Faker\Generator as Faker;

$factory->define(App\Frame::class, function (Faker $faker) {
    return [
        'index' => $faker->numberBetween(1, 10),
        'game_id' => function () {
            return factory(App\Game::class)->create();
        },
    ];
});
