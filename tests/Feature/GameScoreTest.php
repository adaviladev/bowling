<?php

namespace Tests\Feature;

use App\BallThrow;
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

        $this->game = $this->buildGame();
    }

    /** @test */
    function it_should_score_a_gutter_game_as_zero()
    {
        /** Game $game */
        $game = $this->game;
        $game->ballThrows->each(function (BallThrow $ballThrow) {
            $ballThrow->pins = 0;
            $ballThrow->save();
        });

        $game->score();

        $this->assertEquals(0, $this->game->score);
    }

    /** @test */
    function it_should_score_the_sum_of_all_pins_for_a_game()
    {
        $pinCount   = 5;
        $finalScore = $pinCount * 20;

        /** Game $game */
        $game = $this->game;
        $game->ballThrows->each(function (BallThrow $ballThrow) use ($pinCount) {
            $ballThrow->pins = $pinCount;
            $ballThrow->save();
        });

        $game->score();

        $this->assertEquals($finalScore, $this->game->score);
    }

    /** test */
    // function it_should_give_a_two_roll_bonus_for_strikes()
    // {
    //
    // }
}
