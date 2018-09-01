<?php

use Faker\Generator as Faker;

$factory->define(App\Roll::class, function (Faker $faker) {
    return [
        'pins' => $faker->numberBetween(0, 10),
    ];
});
