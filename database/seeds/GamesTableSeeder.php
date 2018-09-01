<?php

use App\User;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            factory(\App\Game::class, 3)->create(['user_id' => $user->id]);
        }
    }
}
