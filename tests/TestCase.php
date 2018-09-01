<?php

namespace Tests;

use App\Roll;
use App\Exceptions\Handler;
use App\Frame;
use App\Game;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->user = create(User::class);
    }

    protected function signIn($user = null){
        $user = $user ?: create(User::class);

        $this->user = $user;
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
        $this->app->instance(
            ExceptionHandler::class,
            $this->oldExceptionHandler
        );

        return $this;
    }

    /**
     * @param string $relation
     * @return mixed
     */
    protected function randomUser($relation = 'games')
    {
        return User::with($relation)
                     ->inRandomOrder()
                     ->first();
    }

    public function buildGames(int $times = 1, User $user = null)
    {
        $bowler = $user ?? $this->user;
        $games = [];
        for ($i = 0; $i < $times; $i++) {
            $games[] = $this->buildGame($bowler);
        }

        return collect($games);
    }

    /**
     * @param User|null $user
     *
     * @return Game
     */
    protected function buildGame(User $user = null): Game
    {
        $bowler = $user ?? $this->user;
        $game = create(Game::class, ['user_id' => $bowler->id]);
        $frames = create(Frame::class, ['game_id' => $game->id], 10);

        foreach ($frames as $frame) {
            $this->buildFrame($frame);
        }

        return $game->load(['frames.rolls']);
    }

    /**
     * @param $frame
     */
    protected function buildFrame($frame, $attributes = []): void
    {
        $index = random_int(0, \count(Roll::$scores) - 1);
        $pins1 = Roll::$scores[$index];
        $pins2 = Roll::getSecondScore($pins1);
        create(
            Roll::class,
            [
                'frame_id' => $frame->id,
                'index'    => 1,
                'pins'     => $attributes['pins1'] ?? $pins1
            ]
        );
        create(
            Roll::class,
            [
                'frame_id' => $frame->id,
                'index'    => 2,
                'pins'     => $attributes['pins2'] ?? $pins2
            ]
        );
    }
}