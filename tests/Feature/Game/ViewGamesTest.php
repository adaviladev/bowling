<?php

namespace Tests\Feature\Game;

use App\Frame;
use App\Game;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_all_games(): void
    {
        $games = create(Game::class, [], 2);

        $response = $this->get('/games');

        $games->each(function (Game $game) use ($response) {
            $response->assertSee('game-' . $game->id);
        });
    }

    /** @test */
    public function it_should_show_a_single_game(): void
    {
        $game = create(Game::class);

        $this->get($game->path())
            ->assertSee('game-' . $game->id);
    }
}
