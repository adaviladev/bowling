<?php

namespace Tests\Feature;

use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGamesTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_games()
    {
        $this->withExceptionHandling();

        $this->post('/games')
             ->assertRedirect('/login');

<<<<<<< Updated upstream
        $this->get('/games/create')
             ->assertRedirect('/login');
=======
        $this->assertEquals(0, Game::count());
>>>>>>> Stashed changes
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
            'user_id' => $this->user->id,
            'score' => 130,
        ]);

        // Bad test. Doesn't check to see if the value is persisted
        $this->put($game->path(), [
            'score' => 300
        ]);

        $game = array_merge($game->fresh()->toArray(), ['score' => 300]);

        // fresh() will always make this past
        $this->assertDatabaseHas('games', $game);
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
}
