<?php

namespace Tests;

use App\Roll;
use App\Exceptions\Handler;
use App\Game;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected const MAX_PIN_COUNT = 10;

    /** @var Game */
    protected $game;

    /** @var \Illuminate\Support\Collection */
    protected $rolls;

    /** @var ExceptionHandler */
    protected $originalExceptionHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->game  = make(Game::class);
        $this->user  = create(User::class);
        $this->rolls = collect();
    }

    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);

        $this->user = $user;
        $this->actingAs($user);

        return $this;
    }

    protected function disableExceptionHandling(): void
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(
            ExceptionHandler::class,
            new class extends Handler
            {
                public function __construct()
                {
                }

                public function report(\Exception $e): void
                {
                }

                public function render($request, \Exception $e)
                {
                    throw $e;
                }
            }
        );
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
     *
     * @return mixed
     */
    protected function randomUser($relation = 'games')
    {
        return User::with($relation)
                   ->inRandomOrder()
                   ->first();
    }

    public function createGames(int $times = 1, User $user = null)
    {
        $bowler = $user ?? $this->user;
        $games  = [];
        for ($i = 0; $i < $times; $i ++) {
            $games[] = $this->createGame($bowler);
        }

        return collect($games);
    }

    /**
     * @param User|null $user
     *
     * @return Game
     */
    protected function createGame(User $user = null): Game
    {
        $bowler = $user ?? $this->user;

        return create(Game::class, ['user_id' => $bowler->id]);
    }

    public function makeGame(): Game
    {
        return make(Game::class);
    }

    /**
     * @param       $frame
     * @param array $attributes
     */
    protected function buildFrame($frame, array $attributes = []): void
    {
        $index = random_int(0, \count(Roll::$scores) - 1);
        $pins1 = Roll::$scores[$index];
        $pins2 = Roll::getSecondScore($pins1);
        create(Roll::class, [
            'frame_id' => $frame->id,
            'index'    => 1,
            'pins'     => $attributes['pins1'] ?? $pins1,
        ]);
        create(Roll::class, [
            'frame_id' => $frame->id,
            'index'    => 2,
            'pins'     => $attributes['pins2'] ?? $pins2,
        ]);
    }

    public function rollStrike(): void
    {
        $this->roll(10);
    }

    public function rollSpare(): void
    {
        $this->roll(7);
        $this->roll(3);
    }

    public function rollTimes($count, $pins): \Illuminate\Support\Collection
    {
        for ($i = 0; $i < $count; $i ++) {
            $this->roll($pins);
        }

        return $this->rolls;
    }

    public function roll($pins): \Illuminate\Support\Collection
    {
        $this->rolls->push($pins);

        return $this->rolls;
    }

    /**
     * @return array
     */
    protected function getRolls(): array
    {
        return [
            'rolls' => $this->rolls->toArray(),
        ];
    }
}
