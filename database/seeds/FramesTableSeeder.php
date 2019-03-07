<?php

use App\Frame;
use App\Game;
use App\Roll;
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
            for ($i = 1; $i <= 10; $i ++) {
                $frame         = factory(Frame::class)->create([
                    'game_id' => $game->id,
                ]);
                $roll1         = factory(Roll::class)->create([
                    'frame_id' => $frame->id,
                ]);
                $availablePins = 10 - $roll1->pins;
                $roll2         = factory(Roll::class)->create([
                    'frame_id' => $frame->id,
                    'pins'     => random_int(0, $availablePins),
                ]);
                if ($i === 10 && ($roll1->pins === 10 || $roll1->pins + $roll2->pins === 10)) {
                    factory(Roll::class)->create([
                        'frame_id' => $frame->id,
                    ]);
                }
            }
        });
    }
}
