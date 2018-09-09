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

    /** @test */
    public function it_should_allow_users_to_edit_their_own_games()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id
        ]);

        $this->put($game->path(), [
            'score' => 300
        ]);

        $this->assertDatabaseHas('games', $game->fresh()->toArray());
    }

    /** @test */
    public function it_should_prevent_users_from_updating_another_users_game()
    {
        $this->signIn();
        //$ownGame = create(Game::class, [
        //    'user_id' => $this->user->id,
        //]);
        $otherGame = create(Game::class);
        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

        $this->put($otherGame->path(), [
            'score' => 0
        ]);

        $this->assertDatabaseHas('games', $otherGame->toArray());
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
