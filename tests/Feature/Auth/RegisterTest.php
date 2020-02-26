<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Token;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @var User $user */
    protected $user;

    /** @test */
    public function it_should_register_a_user_in_the_database()
    {
        $this->registerUser();

        $this->assertDatabaseHas('users', [
            'email' => $this->user->email,
        ]);
    }

    /** @test */
    public function it_should_create_a_token_for_newly_registered_users()
    {
        $response = $this->registerUser();

        $response->assertJsonStructure([
            'user',
            'token',
        ]);
    }

    private function registerUser()
    {
        $this->user = make(User::class, [
            'password' => self::PASSWORD,
        ]);

        return $this->post('api/register', [
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'password' => self::PASSWORD,
            'password_confirmation' => self::PASSWORD,
            'email' => $this->user->email,
        ]);
    }
}
