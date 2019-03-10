<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameScoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_scores_a_gutter_game_as_a_zero()
    {
        $this->rollTimes(20, 0);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(0, $this->game->score);
    }

    /** @test */
    public function it_should_score_a_game_of_all_ones_as_twenty()
    {
        $this->rollTimes(20, 1);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(20, $this->game->score);
    }

    /** @test */
    public function a_game_with_two_rolls_of_3_and_5_should_have_a_score_of_8()
    {
        $this->roll(3);
        $this->roll(5);
        $this->rollTimes(18, 0);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(8, $this->game->score);
    }

    /** @test */
    public function it_should_give_a_one_roll_bonus_for_a_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollTimes(17, 0);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(16, $this->game->score);
    }

    /** @test */
    public function it_should_give_a_two_roll_bonus_for_a_strike()
    {
        $this->rollStrike();
        $this->roll(5);
        $this->roll(3);
        $this->rollTimes(16, 0);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(26, $this->game->score);
    }

    /** @test */
    public function it_should_score_a_perfect_game_as_300()
    {
        $this->rollTimes(12, 10);

        $this->game->calculateScore($this->rolls);

        $this->assertEquals(300, $this->game->score);
    }
}
