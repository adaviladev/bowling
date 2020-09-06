<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_login_request_returns_a_jwt_token()
    {
        $this->disableExceptionHandling();
        $user = create(User::class);

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertJsonStructure([
            'token',
            'user',
        ]);
    }

    /** @test */
    public function an_authenticated_user_cannot_make_a_login_request()
    {
        $this->signIn();
        $user = create(User::class);

        $response = $this->post('api/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
    }
}
