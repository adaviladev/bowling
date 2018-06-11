<?php

namespace Tests\Unit;

use App\BallThrow;
use App\Frame;
use App\Game;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    /** @test */
    public function an_authenticated_user_should_be_able_to_see_all_of_their_own_games(): void
    {
        $this->signIn($this->user);

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
        $game = $this->buildBowlingGame();

        $this->assertCount(10, $game->frames);
    }

    /** @test */
    public function a_user_should_be_able_to_see_all_of_his_scores_for_a_game(): void
    {
        $this->signIn($this->user);
        $game = $this->buildBowlingGame();
        $response = $this->get("/games/{$game->id}");
        foreach ($game->frames as $frame) {
            $response->assertSee("score-{$frame->ballThrows[0]->score}");
            $response->assertSee("score-{$frame->ballThrows[1]->score}");
        }
    }

    /**
     * @return Game
     */
    protected function buildBowlingGame(): Game
    {
        $game = create(Game::class, ['user_id' => $this->user->id]);
        $frames = create(Frame::class, ['game_id' => $game->id], 10);

        foreach ($frames as $frame) {
            create(BallThrow::class, ['frame_id' => $frame->id], 2);
        }

        return $game->load(['frames.ballThrows']);
    }
}
