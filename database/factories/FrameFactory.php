<?php

use Faker\Generator as Faker;

$factory->define(App\Frame::class, function (Faker $faker) {
    return [
        'game_id' => function () {
            $game = App\Game::inRandomOrder()->first();
            return optional($game)->id ?? factory(App\Game::class)->create()->id;
        },
        'score' => $faker->numberBetween(0, 10)
    ];
});
