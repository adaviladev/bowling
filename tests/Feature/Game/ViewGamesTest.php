<?php

namespace Tests\Feature\Game;

use App\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_return_all_games(): void
    {
        $games = create(Game::class, [], 2);

        $response = $this->getJson(route('games.index'));

        $games->each(function (Game $game) use ($response) {
            $response->assertJsonFragment($game->toArray());
        });
    }

    /** @test */
    public function it_should_show_a_single_game(): void
    {
        $game = create(Game::class);

        $this->get(route('games.show', ['game' => $game]))
            ->assertSee('game-' . $game->id);
    }
}
