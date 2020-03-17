<?php

use App\Game;
use Faker\Generator as Faker;

$factory->define(App\Roll::class, function (Faker $faker) {
    return [
        'pins' => $faker->numberBetween(0, 10),
        'game_id' => function () {
            $game = Game::inRandomOrder()->first();
            return optional($game)->id ?? factory(Game::class)->create();
        },
        'pin_1' => 0,
        'pin_2' => 0,
        'pin_3' => 0,
        'pin_4' => 0,
        'pin_5' => 0,
        'pin_6' => 0,
        'pin_7' => 0,
        'pin_8' => 0,
        'pin_9' => 0,
        'pin_10' => 0,
    ];
});
