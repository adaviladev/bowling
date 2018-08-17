<?php

use App\Roll;
use Illuminate\Database\Seeder;

class RollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = App\Game::with(['frames'])->get();

        foreach ($games as $game) {
            foreach ($game->frames as $frame) {
                $index = random_int(0, \count(Roll::$scores) - 1);
                $score1 = Roll::$scores[$index];
                $score2 = Roll::getSecondScore($score1);
                factory(\App\Roll::class)->create([
                    'frame_id' => $frame->id,
                    'index' => 1,
                    'score' => $score1
                ]);
                factory(\App\Roll::class)->create([
                    'frame_id' => $frame->id,
                    'index' => 2,
                    'score' => $score2
                ]);
            }
        }
    }
}
