<?php

use App\Frame;
use App\Game;
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
        $game = Game::all();

        $game->each(function (Game $game, $index) {
            for($i = 1; $i <= 10; $i++) {
                factory(Frame::class)->create([
                    'game_id' => $game->id,
                    'score' => ($game->score / 10) * $i
                ]);
            }
        });
    }
}
