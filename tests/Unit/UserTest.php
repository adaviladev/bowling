<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_make_a_string_path_to_their_own_profile_page()
    {
        $user = create(User::class);

        $this->assertEquals("/users/{$user->id}", $user->path());
    }

    /** @test */
    public function it_should_return_a_users_full_name()
    {
        $user = create(User::class);

        $this->assertEquals($user->first_name . ' ' . $user->last_name, $user->fullName);
    }

    /** @test */
    public function it_should_show_all_users()
    {
        $user = create(User::class);

        $this->get('/users')
             ->assertSee($user->fullName);
    }
}
