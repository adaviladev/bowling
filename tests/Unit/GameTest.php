<?php

namespace Tests\Unit;

use App\Game;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_should_be_able_to_see_all_of_their_own_games(): void
    {
        //$user = $this->randomUser();
        $user = create(User::class);

        $this->signIn($user);

        /** @var \App\Game $games */
        $games = $user->games;

        $response = $this->get('/games');

        if($games->count()) {
            $response->assertSee("game-{$games[0]->id}");
        } else {
            $response->assertSee('No games');
        }
    }

    /** @test */
    public function an_unauthenticated_user_should_be_redirected_to_the_login_page(): void
    {
        $this->withExceptionHandling();

        $this->get('/games')
             ->assertRedirect("/login");
    }

    /** @test */
    public function a_user_should_be_able_to_create_a_game(): void
    {
        $user = create(User::class);
        $this->signIn($user);

        $game = new Game;

        $game->user_id = $user->id;
        $gameCount = $user->games->count();

        $response = $this->post('/games', $game->toArray());

        $this->assertCount($gameCount + 1, $user->fresh()->games);
        $response->assertJson(['status' => 'Game created.']);
    }
}
