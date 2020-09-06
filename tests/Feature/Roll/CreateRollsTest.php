<?php

namespace Tests\Feature\Roll;

use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
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
        $this->expectException(ValidationException::class);

        $this->post(route('rolls.store', ['game' => $game]), $this->getRolls());
    }

    /** @test */
    public function when_rolls_are_submitted_twenty_rolls_should_be_generated_for_the_submitted_game()
    {
        $this->signIn();
        $game = create(Game::class);
        $this->rollTimes(20, 0);

        $this->post(route('rolls.store', ['game' => $game]), $this->getRolls());

        $this->assertCount(20, $game->rolls);
    }

    /** @test */
    public function a_gutter_game_should_create_twenty_rolls()
    {
        $this->signIn();
        $game = create(Game::class);
        $rolls = $this->rollTimes(20, 0);

        $this->post(route('rolls.store', ['game' => $game]), [
            'rolls' => $rolls->toArray(),
        ]);

        $this->assertEquals(20, $game->rolls()->count());
        $this->assertEquals(20, Roll::count());
    }

    /** @test */
    public function a_game_cannot_have_less_than_12_rolls()
    {
        $this->signIn();
        $this->withExceptionHandling();
        $game = create(Game::class);
        $rolls = make(Roll::class, ['pins' => 0], 11)->pluck('pins');

        $response = $this->postJson(route('rolls.store', ['game' => $game]), [
            'rolls' => $rolls,
        ]);
        $content = json_decode($response->getContent());

        $this->assertContains('The rolls must have at least 12 items.', $content->errors->rolls);
    }

    /** @test */
    public function a_game_cannot_have_more_than_20_rolls()
    {
        $this->signIn();
        $this->withExceptionHandling();
        $game = create(Game::class);
        $rolls = make(Roll::class, ['pins' => 0], 21)->pluck('pins');

        $response = $this->postJson(route('rolls.store', ['game' => $game]), [
            'rolls' => $rolls,
        ]);
        $content = json_decode($response->getContent());

        $this->assertContains('The rolls may not have more than 20 items.', $content->errors->rolls);
    }
}
