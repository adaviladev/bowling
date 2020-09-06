<?php

namespace Tests\Feature\Game;

use App\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateGamesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_allow_users_to_edit_their_own_games()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id,
        ]);

        $this->put(route('games.update', ['game' => $game]), [
            'score' => 300,
        ]);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'user_id' => $game->user_id,
            'score' => $game->score,
            'complete' => $game->complete,
        ]);
    }

    /** @test */
    public function it_should_prevent_users_from_updating_another_users_game()
    {
        $this->signIn();
        $otherGame = create(Game::class);
        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);

        $this->put(route('games.update', ['game' => $otherGame]), [
            'score' => 0,
        ]);

        $this->assertDatabaseHas('games', $otherGame->toArray());
    }

    /** @test */
    public function a_games_score_should_not_be_less_than_zero()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id,
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->put(route('games.update', ['game' => $game]), ['score' => -1]);
    }

    /** @test */
    public function a_games_score_should_not_be_greater_than_three_hundred()
    {
        $this->signIn();
        $game = create(Game::class, [
            'user_id' => $this->user->id,
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->put(route('games.update', ['game' => $game]), ['score' => 301]);
    }
}
