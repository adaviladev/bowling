<?php

use App\Frame;
use Faker\Generator as Faker;

$factory->define(App\Roll::class, function (Faker $faker) {
    return [
        'pins' => $faker->numberBetween(0, 10),
        'frame_id' => function () {
            $frame = Frame::inRandomOrder()->first();
            return optional($frame)->id ?? factory(Frame::class)->create();
        }
    ];
});
