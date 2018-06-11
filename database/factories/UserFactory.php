<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\User::inRandomOrder()
                           ->first()->id;
        },
    ];
});

$factory->define(App\Frame::class, function (Faker $faker) {
    return [
        'game_id' => function () {
            return App\Game::inRandomOrder()
                           ->first()->id;
        },
    ];
});

$factory->define(App\BallThrow::class, function (Faker $faker) {
    $scores = ['-', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'X', '/'];
    return [
        'frame_id' => function () {
            return App\Frame::inRandomOrder()
                           ->first()->id;
        },
        'index' => $faker->numberBetween(1,10),
        'score' => $faker->numberBetween(1, 9)
    ];
});
