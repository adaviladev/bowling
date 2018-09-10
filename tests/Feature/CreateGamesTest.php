<?php

namespace Tests\Feature;

use App\Game;
use App\Roll;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_view_the_create_game_form()
    {
        $this->withExceptionHandling();

        $this->get('/games/create')
             ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_show_authenticated_users_the_game_creation_form()
    {
        $this->signIn();

        $response = $this->get('/games/create');

        $response->assertSee('<form');
        $response->assertSee('id="game-create-form"');
    }

    /** @test */
    public function guests_may_not_create_games()
    {
        $this->withExceptionHandling();

        $response = $this->post('/games');

        $response->assertRedirect('/login');
        $this->assertEquals(0, Game::count());
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
    public function it_should_create_one_frame_with_two_rolls()
    {
        $this->signIn();
        $game = create(Game::class, ['user_id' => $this->user->id]);

        $this->put($game->path(), [
            'rolls' => [1, 3]
        ]);

        $this->assertCount(2, $game->rolls);
    }
}
