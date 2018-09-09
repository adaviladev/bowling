<?php

namespace Tests\Unit;

use App\Frame;
use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RollTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_roll_should_be_associated_to_a_frame()
    {
        $frame = create(Frame::class);
        $roll = make(Roll::class);

        $frame->rolls()->save($roll);

        $this->assertDatabaseHas('rolls', $roll->toArray());
    }

    /** @test */
    public function a_roll_should_have_a_pins_key()
    {
        $roll = create(Roll::class);

        $this->assertArrayHasKey('pins', $roll->toArray());
    }

    /**  test */
    public function a_roll_cannot_knock_down_more_than_ten_pins()
    {
        $this->signIn();
        $game = create(Game::class, ['user_id' => $this->user->id]);
        $roll = make(Roll::class, ['pins' => '11']);

        $this->put($game->path(), $roll->toArray());

        $this->assertTrue(false);
    }
}
