<?php

use App\Game;
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
        $game = Game::all();

        $game->each(function (Game $game, $index) {
            $rolls = collect();
            for ($i = 1; $i <= 10; $i++) {
                $roll1 = factory(Roll::class)->create([
                    'game_id' => $game->id,
                ]);
                $availablePins = 10 - $roll1->pins;
                $rolls->push($roll1->pins);

                $roll2 = null;
                if ($availablePins !== 0 || ($roll1->pins === 10 && $i === 10)) {
                    $roll2 = factory(Roll::class)->create([
                        'game_id' => $game->id,
                        'pins' => random_int(0, $availablePins),
                    ]);
                    $rolls->push($roll2->pins);
                }

                if ($i === 10 && $this->earnedThirdRoll($roll1, $roll2)) {
                    $roll3 = factory(Roll::class)->create([
                        'game_id' => $game->id,
                    ]);
                    $rolls->push($roll3->pins);
                }
            }

            $game->calculateScore($rolls)
                ->save();
        });
    }

    public function earnedThirdRoll($roll1, $roll2): bool
    {
        return $roll1->pins === 10 || ($roll2 && $roll1->pins + $roll2->pins === 10);
    }
}
