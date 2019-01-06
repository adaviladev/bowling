<?php

namespace Tests\Unit;

use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_game_can_make_a_string_path()
    {
        $game = create(Game::class);

        $this->assertEquals("/games/{$game->id}", $game->path());
    }

    /** @test */
    public function it_should_show_authenticated_users_the_edit_form_for_a_game()
    {
        $this->signIn();
        $game = create(Game::class);

        $this->get(route('games.edit', $game->id))->assertSee('Edit Game ' . $game->id);
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
}
