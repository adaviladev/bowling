<?php

namespace Tests\Feature;

use App\Frame;
use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateRollsTest extends TestCase
{
    use DatabaseMigrations;

    /**  test */
    public function a_roll_cannot_knock_down_more_than_ten_pins()
    {
        $this->signIn();
        $game = create(Game::class, ['user_id' => $this->user->id]);
        $roll = make(Roll::class, ['pins' => '11']);

        $this->put($game->path(), $roll->toArray());

        $this->assertTrue(false);
    }

    /** @test */
    public function a_roll_can_be_saved()
    {
        $this->signIn();
        $game = $this->createGame();
        $rolls = [1];

        $this->post($game->path() . '/rolls', [
            'rolls' => $rolls
        ]);

        $this->assertEquals(1, Roll::count());
    }

    /** @test */
    public function a_roll_should_belong_to_a_frame()
    {
        $this->signIn();
        $game = $this->createGame();

        $this->post($game->path() . '/rolls', [
            'rolls' => [2],
        ]);

        $frame = $game->frames()->first();

        $this->assertDatabaseHas('rolls', [
            'frame_id' => $frame->id,
            'pins' => 2
        ]);
    }

    ///** @test */
    //public function a_strike_and_a_five_roll_should_create_two_frames_instead_of_one()
    //{
    //    $this->signIn();
    //    $game = $this->buildGame();
    //    $rolls = [10, 5];
    //
    //    $this->post($game->path() . '/rolls', [
    //        'rolls' => $rolls,
    //    ]);
    //
    //    $this->assertEquals(2, Frame::count());
    //}
}
