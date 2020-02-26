<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_delete_a_users_access_token_upon_logging_out()
    {
        /** @var User $user */
        $user = create(User::class, [
            'first_name' => 'Logout',
            'last_name' => 'Tester'
        ]);
        $token = $user->createToken(__CLASS__);

        $this->post('api/logout', $data = [], [
            'Authorization' => "Bearer {$token->accessToken}",
        ]);

        $this->assertDatabaseMissing('oauth_access_tokens', $token->toArray());
    }
}
