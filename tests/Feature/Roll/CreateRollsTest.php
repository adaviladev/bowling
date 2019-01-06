<?php

namespace Tests\Feature\Roll;

use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRollsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_roll_cannot_knock_down_more_than_ten_pins()
    {
        $this->signIn();
        $game = create(Game::class, ['user_id' => $this->user->id]);
        $this->roll(11);
        $this->rollTimes(19, 0);
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->post($game->path() . '/rolls', $this->getRolls());
    }

    /** @test */
    public function when_rolls_are_submitted_ten_frames_should_be_generated_for_the_submitted_game()
    {
        $this->signIn();
        $game = $this->createGame();
        $this->rollTimes(20, 0);

        $this->post($game->path() . '/rolls', $this->getRolls());

        $this->assertCount(10, $game->frames);
    }



    /** @test */
    public function a_gutter_game_should_create_twenty_rolls_across_ten_frames()
    {
        $this->signIn();
        $game = create(Game::class);
        $rolls = $this->rollTimes(20, 0);

        $this->post($game->path() . '/rolls', [
            'rolls' => $rolls->toArray(),
        ]);

        $this->assertEquals(10, $game->frames()->count());
        $this->assertEquals(20, Roll::count());
    }
}
