<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_login_request_returns_a_jwt_token()
    {
        $this->disableExceptionHandling();
        $user = create(User::class);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertJsonStructure([
            'token',
            'user',
        ]);
    }
}
