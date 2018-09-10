<?php

namespace Tests\Feature\Game;

use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateGamesTest extends TestCase
{
    use DatabaseMigrations;

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
        $otherGame = create(Game::class);
        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

        $this->put($otherGame->path(), [
            'score' => 0
        ]);

        $this->assertDatabaseHas('games', $otherGame->toArray());
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
