<?php

use Faker\Generator as Faker;

$factory->define(App\Roll::class, function (Faker $faker) {
    return [
        'frame_id' => function () {
            return App\Frame::inRandomOrder()
                            ->first()->id;
        },
        'index' => $faker->numberBetween(1,2),
        'pins' => $faker->numberBetween(1, 9)
    ];
});
