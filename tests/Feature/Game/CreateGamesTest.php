<?php

namespace Tests\Feature\Game;

use App\Game;
use App\Roll;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_games()
    {
        $this->expectException(AuthenticationException::class);

        $this->post(route('games.store'));

        $this->assertEquals(0, Game::count());
    }

    /** @test */
    public function it_should_store_a_game()
    {
        $this->signIn();
        $game = make(Game::class);
        unset($game->user_id);

        $this->post(route('games.store', ['game' => $game]), $game->toArray());

        $this->assertDatabaseHas('games', $game->toArray());
    }

    /** @test */
    public function stored_games_should_belong_to_the_currently_authenticated_user()
    {
        $this->signIn();
        $game = make(Game::class);

        $this->post(route('games.index'), $game->toArray());
        $usersGame = $this->user->games()->first();

        $this->assertEquals($this->user->id, $usersGame->user_id);
    }

    /** @test */
    public function it_should_create_one_game_with_two_rolls()
    {
        $this->signIn();
        $game = create(Game::class, ['user_id' => $this->user->id]);

        $this->put(route('games.update', ['game' => $game]), [
            'rolls' => [1, 3]
        ]);

        $this->assertCount(2, $game->rolls);
    }
}
