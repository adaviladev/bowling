<?php

use App\BallThrow;
use Illuminate\Database\Seeder;

class BallThrowsTableSeeder extends Seeder
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
                $index = random_int(0, \count(BallThrow::$scores) - 1);
                $score1 = BallThrow::$scores[$index];
                $score2 = BallThrow::getSecondScore($score1);
                factory(\App\BallThrow::class)->create([
                    'frame_id' => $frame->id,
                    'index' => 1,
                    'score' => $score1
                ]);
                factory(\App\BallThrow::class)->create([
                    'frame_id' => $frame->id,
                    'index' => 2,
                    'score' => $score2
                ]);
            }
        }
    }
}
