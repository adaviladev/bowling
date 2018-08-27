<?php

namespace Tests\Unit;

use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GameScoreTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_games_score_should_not_be_less_than_zero()
    {
        $this->signIn();
        $game = make(Game::class, [
            'score' => -1,
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post($game->path(), $game->toArray());
    }

    /** @test */
    public function a_games_score_should_not_be_greater_than_three_hundred()
    {
        $this->signIn();
        $game = make(Game::class, [
            'score' => 301,
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post($game->path(), $game->toArray());
    }
}
