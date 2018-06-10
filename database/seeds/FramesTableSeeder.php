<?php

use Illuminate\Database\Seeder;

class FramesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = \App\Game::all();

        foreach ($games as $game) {
            factory(App\Frame::class, 10)->create(['game_id' => $game->id]);
        }
    }
}
