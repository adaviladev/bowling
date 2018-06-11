<?php

namespace Tests;

use App\Exceptions\Handler;
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
}