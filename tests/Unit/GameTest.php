<?php

namespace Tests\Unit;

use App\Frame;
use App\Game;
use App\Roll;
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
    public function it_should_show_authenticated_users_the_game_creation_form()
    {
        $this->signIn();

        $response = $this->get('/games/create');

        $response->assertSee('<form');
        $response->assertSee('id="game-create-form"');
    }

    /** @test */
    public function guests_may_not_see_the_game_create_form()
    {
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $this->get(route('games.create'))
             ->assertRedirect('/login');
    }

    /** @test */
    public function it_should_show_authenticated_users_the_edit_form_for_a_game()
    {
        $this->signIn();
        $game = create(Game::class);

        $this->get(route('games.edit', $game->id))->assertSee('Edit Game ' . $game->id);
    }

    /** @test */
    public function it_should_show_a_single_game(): void
    {
        $game = create(Game::class);

        $this->get($game->path())
            ->assertSee('game-' . $game->id);
    }

    /** @test */
    public function a_game_should_have_a_score()
    {
        $game = create(Game::class);

        $this->assertArrayHasKey('score', $game->toArray());
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
    public function when_a_game_is_deleted_all_of_its_associated_frames_should_be_deleted()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id
        ]);
        $frames = create(Frame::class, [
            'game_id' => $game->id
        ], 10);
        $game->frames()->saveMany($frames);

        $this->delete($game->path())
             ->assertRedirect('/games');

        $this->assertDatabaseMissing('frames', ['game_id' => $game->id]);
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
    public function it_should_create_one_frame_with_two_rolls()
    {
        $this->signIn();
        $rolls = make(Roll::class, ['pins' => 1], 2);
        $game = create(Game::class, ['user_id' => $this->user->id]);

        $this->put($game->path(), [
            'rolls' => $rolls->toArray()
        ]);

        $this->assertCount(2, $game->rolls);
    }
    // Patterns of Enterprise Application Architecture
}
