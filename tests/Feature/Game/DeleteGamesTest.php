<?php

namespace Tests\Feature\Game;

use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $this->delete(route('games.destroy', ['game' => $game]))
             ->assertStatus(200);

        $this->assertDatabaseMissing('frames', ['game_id' => $game->id]);
        $this->assertEquals(0, Game::count());
        $this->assertEquals(0, Frame::count());
    }

    /** @test */
    public function it_should_return_a_200_status_when_you_delete_a_game()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id,
        ]);

        $this->delete(route('games.destroy', ['game' => $game]))
            ->assertStatus(200);
    }

    /** @test */
    public function an_unauthenticated_user_may_not_delete_a_game()
    {
        $this->withExceptionHandling();
        $game = create(Game::class);

        $this->delete(route('games.destroy', ['game' => $game]))
             ->assertRedirect('/login');

        $this->signIn();
        $this->delete(route('games.destroy', ['game' => $game]))
             ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_delete_a_game()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id
        ]);

        $this->delete(route('games.destroy', ['game' => $game]));

        $this->assertDatabaseMissing('games', $game->toArray());
    }
}
