<?php

namespace Tests\Unit;

use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_game_can_make_a_string_path()
    {
        $game = create(Game::class);

        $this->assertEquals("/api/games/{$game->id}", $game->path());
    }

    /** @test */
    public function a_game_should_have_a_score()
    {
        $game = create(Game::class);

        $this->assertArrayHasKey('score', $game->toArray());
    }

    /** @test */
    public function it_should_return_a_games_rolls()
    {
        $game = create(Game::class);
        create(Roll::class, ['game_id' => $game->id], 12);

        $queriedRolls = $game->rolls()->get();

        $this->assertNotNull($queriedRolls);
        $this->assertNotNull($game->rolls);
    }

    /** @test */
    public function it_should_return_twelve_rolls_for_a_completed_perfect_game()
    {
        $game = create(Game::class, ['complete' => true]);
        create(Roll::class, ['game_id' => $game->id], 12);

        $this->assertCount(12, $game->rolls);
    }
}
