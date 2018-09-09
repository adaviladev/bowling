<?php

namespace Tests\Feature;

use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteGamesTest extends TestCase
{
    use DatabaseMigrations;

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
}
