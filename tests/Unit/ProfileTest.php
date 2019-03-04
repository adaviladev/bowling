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

        $response = $this->getJson('/api/users');

        $users->each(function (User $user) use ($response) {
            $response->assertJsonFragment($user->toArray());
        });
    }

    /** @test */
    public function it_should_render_the_users_home_page()
    {
        $this->signIn();

        $this->get(route('home'))
             ->assertSee($this->user->fullName);
    }

    /** @test */
    public function it_should_return_a_users_profile_as_json()
    {
        $user = create(User::class);

        $this->getJson($user->path())
             ->assertJsonFragment($user->toArray());
    }

    /** @test */
    public function it_should_redirect_authenticated_users_away_from_the_login_screen()
    {
        $this->signIn();

        $this->get(route('login'))
             ->assertRedirect(route('home'));
    }

    /** @test */
    public function it_should_allow_guests_to_view_the_login_screen()
    {
        $this->get(route('login'))
             ->assertViewIs('auth.login');

    }
}
