<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_show_a_list_of_all_of_the_users()
    {
        $users = create(User::class, [], 3);

        $response = $this->get('/users');

        $users->each(function ($user) use ($response) {
            $response->assertSee($user->fullName);
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
    public function it_should_show_a_users_profile()
    {
        $user = create(User::class);

        $this->get($user->path())
             ->assertSee("{$user->fullName}'s Profile");
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
