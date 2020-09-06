<?php

namespace App\Providers;

use App\Game;
use App\Policies\GamePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Game::class => GamePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes(static function (\Laravel\Passport\RouteRegistrar $router) {
            $router->forAccessTokens();
            $router->forTransientTokens();
        });

        Passport::personalAccessClientId(1);
    }
}
