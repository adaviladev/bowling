<?php

namespace Tests\Feature;

use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGamesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_may_not_create_games()
    {
        $this->withExceptionHandling();

        $this->post('/games')
             ->assertRedirect('/login');

        $this->get('/games/create')
             ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_store_a_game()
    {
        $this->signIn();
        $game = make(Game::class);
        unset($game->user_id);

        $this->post($game->path(), $game->toArray());

        $this->assertDatabaseHas('games', $game->toArray());
    }

    /** @test */
    public function stored_games_should_belong_to_the_currently_authenticated_user()
    {
        $this->signIn();
        $game = make(Game::class);

        $this->post('games', $game->toArray());
        $usersGame = $this->user->games()->first();

        $this->assertEquals($this->user->id, $usersGame->user_id);
    }

    /** @test */
    public function an_unauthenticated_user_may_not_delete_a_game()
    {
        $this->withExceptionHandling();
        $game = create(Game::class);

        $this->delete($game->path())
             ->assertRedirect('/login');

        $this->signIn();
        $this->delete($game->path())
             ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_delete_a_game()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id
        ]);

        $this->delete($game->path());

        $this->assertDatabaseMissing('games', $game->toArray());
    }

}
