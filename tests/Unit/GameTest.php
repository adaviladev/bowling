<?php

namespace Tests\Unit;

use App\Roll;
use App\Frame;
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
        $this->signIn($this->user);
        $this->buildGame();

        /** @var \App\Game $games */
        $games = $this->user->games;

        $response = $this->get('/games');

        if ($games->count()) {
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
        $this->signIn($this->user);

        $game = new Game;

        $game->user_id = $this->user->id;
        $gameCount = $this->user->games->count();

        $response = $this->post('/games', $game->toArray());

        $this->assertCount($gameCount + 1, $this->user->fresh()->games);
        $response->assertJson(['status' => 'Game created.']);
    }

    /** @test */
    public function a_game_should_have_exactly_ten_frames(): void
    {
        $game = $this->buildGame();

        $this->assertCount(10, $game->frames);
    }

    /** @test */
    public function a_user_should_be_able_to_see_all_of_his_scores_for_a_game(): void
    {
        $this->signIn($this->user);
        $game = $this->buildGame();
        $response = $this->get($game->path());
        foreach ($game->frames as $frame) {
            $response->assertSee("score-{$frame->rolls[0]->score}");
            $response->assertSee("score-{$frame->rolls[1]->score}");
        }
    }

    /** @test */
    function a_user_should_be_able_to_delete_his_own_game()
    {
        $this->signIn($this->user);
        $game = $this->buildGame();

        $this->delete($game->path());

        $this->assertDatabaseMissing('games', ['id' => $game->id]);
    }

    /** @test */
    function when_a_game_is_deleted_all_of_its_frame_and_ball_throw_data_should_also_be_deleted()
    {
        $this->signIn($this->user);
        $game = $this->buildGame();

        $this->delete($game->path());

        $this->assertDatabaseMissing('frames', ['game_id' => $game->id]);
    }

    /** @test */
    function an_authenticated_user_may_not_see_another_persons_games()
    {
        $bowler = create(User::class);

        $this->signIn();
        $this->buildGame();
        $game = $this->buildGame($bowler);

        $this->get($game->path())->assertDontSee("game-{$game->id}");
    }
}
