<?php

namespace Tests\Unit;

use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_game_can_make_a_string_path()
    {
        $game = create(Game::class);

        $this->assertEquals("/games/{$game->id}", $game->path());
    }

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
    public function it_should_show_a_single_game(): void
    {
        $game = create(Game::class);

        $this->get($game->path())
            ->assertSee('game-' . $game->id);
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
    public function a_game_should_have_a_score()
    {
        $game = create(Game::class);

        $this->assertArrayHasKey('score', $game->toArray());
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
    public function it_should_return_a_games_rolls()
    {
        $game = create(Game::class);
        create(Frame::class, ['game_id' => $game->id], 10);

        $queriedFrames = $game->frames()->get();

        $this->assertNotNull($queriedFrames);
        $this->assertNotNull($game->frames);
    }

    /** @test */
    public function it_should_return_ten_frames_for_completed_games()
    {
        $game = create(Game::class, ['complete' => true]);
        create(Frame::class, ['game_id' => $game->id], 10);

        $this->assertCount(10, $game->frames);
    }

    /** @test */
    public function a_game_can_be_deleted()
    {
        $this->signIn();
        $game = create(Game::class);

        $this->delete($game->path());

        $this->assertDatabaseMissing('games', $game->toArray());
    }

    /** @test */
    public function when_a_game_is_deleted_all_of_its_associated_frames_should_be_deleted()
    {
        $this->signIn();
        $game = create(Game::class);
        $frames = create(Frame::class, ['game_id' => $game->id], 10);
        $game->frames()->saveMany($frames);

        $this->delete($game->path());

        $this->assertDatabaseMissing('frames', ['game_id' => $game->id]);
    }

    /** @test */
    public function it_should_redirect_you_to_your_index_page_when_you_delete_a_game()
    {
        $this->signIn();
        $game = create(Game::class);

        $this->delete($game->path())
            ->assertRedirect('/games');
    }
}
