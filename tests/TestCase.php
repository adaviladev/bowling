<?php

namespace Tests;

use App\BallThrow;
use App\Exceptions\Handler;
use App\Frame;
use App\Game;
use App\User as Bowler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Tests\Unit\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->user = create(Bowler::class);
    }

    protected function signIn($user = null){
        $user = $user ?: create('App\User');

        $this->actingAs($user);

        return $this;
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}
            public function report(\Exception $e) {}
            public function render($request, \Exception $e) {
                throw $e;
            }
        });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }

    /**
     * @param string $relation
     * @return mixed
     */
    protected function randomUser($relation = 'games')
    {
        return Bowler::with($relation)
                     ->inRandomOrder()
                     ->first();
    }

    /**
     * @return Game
     */
    protected function buildBowlingGame(): Game
    {
        $game = create(Game::class, ['user_id' => $this->user->id]);
        $frames = create(Frame::class, ['game_id' => $game->id], 10);

        $scores = ['-', 1, 2, 3, 4, 5, 6, 7, 8, 9, 'X', '/'];

        foreach ($frames as $frame) {
            $index = random_int(0, \count(BallThrow::$scores) - 1);
            $score1 = BallThrow::$scores[$index];
            $score2 = BallThrow::getSecondScore($score1);
            create(
                BallThrow::class,
                [
                    'frame_id' => $frame->id,
                    'index' => 1,
                    'score' => $score1
                ]
            );
            create(
                BallThrow::class,
                [
                    'frame_id' => $frame->id,
                    'index' => 2,
                    'score' => $score2
                ]
            );
        }

        return $game->load(['frames.ballThrows']);
    }
}