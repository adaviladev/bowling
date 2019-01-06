<?php

namespace Tests\Feature\Game;

use App\Frame;
use App\Game;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_a_game_is_deleted_all_of_its_associated_frames_should_be_deleted()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id
        ]);
        $game->frames()->saveMany(make(Frame::class, [], 10));

        //dd(Game::count());
        $this->delete($game->path())
             ->assertRedirect('/games');

        $this->assertDatabaseMissing('frames', ['game_id' => $game->id]);
        $this->assertEquals(0, Game::count());
        $this->assertEquals(0, Frame::count());
    }

    /** @test */
    public function it_should_redirect_you_to_your_index_page_when_you_delete_a_game()
    {
        $this->signIn();
        //dd($this->user->id);
        $game = create(Game::class, [
            'user_id' => $this->user->id,
        ]);

        $this->delete($game->path())
            ->assertRedirect('/games');
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
