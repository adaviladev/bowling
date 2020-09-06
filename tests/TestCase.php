<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Game;
use App\Roll;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected const MAX_PIN_COUNT = 10;
    public const PASSWORD = 'secret';

    /** @var Game */
    protected $game;

    /** @var \Illuminate\Support\Collection */
    protected $rolls;

    /** @var ExceptionHandler */
    protected $originalExceptionHandler;

    protected function setUp(): void
    {
        parent::setUp();

        \Artisan::call('passport:install');

        $this->disableExceptionHandling();

        $this->game = make(Game::class);
        $this->user = create(User::class);
        $this->rolls = collect();
    }

    protected function signIn($user = null, $scopes = [])
    {
        $user = $user ?: create(User::class);

        $this->user = $user;
        Passport::actingAs($user, $scopes);

        return $this;
    }

    protected function disableExceptionHandling(): void
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class,
            new class extends Handler {
                public function __construct()
                {
                }

                public function report(\Throwable $e): void
                {
                }

                public function render($request, \Throwable $e)
                {
                    throw $e;
                }
            });
    }

    protected function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class,
            $this->oldExceptionHandler);

        return $this;
    }

    /**
     * @param string $relation
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
        $games = [];
        for ($i = 0; $i < $times; $i++) {
            $games[] = $this->createGame($bowler);
        }

        return collect($games);
    }

    protected function createGame(User $user = null): Game
    {
        $bowler = $user ?? $this->user;
        $game = create(Game::class, ['user_id' => $bowler->id]);
        $this->buildRolls($game);

        return $game;
    }

    public function makeGame(): Game
    {
        return make(Game::class);
    }

    /**
     * @throws \Exception
     */
    protected function buildRolls(Game $game): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $roll1 = factory(Roll::class)->create([
                'game_id' => $game->id,
            ]);
            $availablePins = 10 - $roll1->pins;
            $roll2 = factory(Roll::class)->create([
                'game_id' => $game->id,
                'pins' => random_int(0, $availablePins),
            ]);
            if ($i === 10 && ($roll1->pins === 10 || $roll1->pins + $roll2->pins === 10)) {
                factory(Roll::class)->create([
                    'game_id' => $game->id,
                ]);
            }
        }
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
        for ($i = 0; $i < $count; $i++) {
            $this->roll($pins);
        }

        return $this->rolls;
    }

    public function roll($pins): \Illuminate\Support\Collection
    {
        $this->rolls->push($pins);

        return $this->rolls;
    }

    protected function getRolls(): array
    {
        return [
            'rolls' => $this->rolls->toArray(),
        ];
    }
}
