<?php

namespace Tests\Unit;

use App\Roll;
use App\Frame;
use App\Game;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

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
    public function it_should_show_a_single_game()
    {
        $game = create(Game::class);

        $this->get($game->path())
            ->assertSee('game-' . $game->id);
    }


}
