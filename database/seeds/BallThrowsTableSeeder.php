<?php

use Illuminate\Database\Seeder;

class BallThrowsTableSeeder extends Seeder
{
    protected $scores = [
        '-', 1, 2, 3, 4, 5, 6, 7, 8, 9, '/', 'X'
    ];
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
                $index = random_int(0, \count($this->scores) - 1);
                $score1 = $this->scores[$index];
                $score2 = $this->getSecondScore($score1);
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

    private function getSecondScore($score1)
    {
        $score = null;
        if($score1 === 'X') {
            return null;
        }

        return $this->scores[random_int(0, \count($this->scores) - 2)];
    }
}
