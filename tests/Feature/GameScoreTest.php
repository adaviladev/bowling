<?php

namespace Tests\Feature;

use App\Roll;
use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameScoreTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Game $this->game
     */
    public function setUp()
    {
        parent::setUp();

        /** @var Game game */
        $this->game = $this->buildGame();
    }

    /** @test */
    function it_should_score_a_gutter_game_as_zero()
    {
        /** Game $game */
        $game = $this->game;
        $game->rolls->each(function (Roll $roll) {
            $roll->pins = 0;
            $roll->save();
        });

        $game->score();

        $this->assertEquals(0, $this->game->score);
    }

    /** @test */
    function it_should_score_the_sum_of_all_pins_for_a_game()
    {
        $pinCount   = 1;
        $finalScore = $pinCount * 20;

        /** Game $game */
        $game = $this->game;
        $game->rolls->each(function (Roll $roll) use ($pinCount) {
            $roll->pins = $pinCount;
            $roll->save();
        });

        $game->score();

        $this->assertEquals($finalScore, $game->score);
    }

}
