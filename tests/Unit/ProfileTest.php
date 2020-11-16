<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_return_a_list_of_all_of_the_users()
    {
        $users = create(User::class, [], 3);

        $response = $this->getJson(route('users.index'));

        $users->each(function (User $user) use ($response) {
            $response->assertJsonFragment($user->toArray());
        });
    }

    /** @test */
    public function it_should_return_a_users_profile_as_json()
    {
        $user = create(User::class);

        $this->getJson($user->path())
             ->assertJsonFragment($user->toArray());
    }
}
