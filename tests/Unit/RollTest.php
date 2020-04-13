<?php

namespace Tests\Unit;

use App\Game;
use App\Roll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_roll_should_be_associated_to_a_game(): void
    {
        $game = create(Game::class);
        $roll  = make(Roll::class);

        $game->rolls()
              ->save($roll);

        $this->assertDatabaseHas('rolls', ['game_id' => $roll->game_id]);
        $this->assertTrue($roll->game->is($game));
    }

    /** @test */
    public function a_roll_has_a_record_of_the_pins_that_it_hit(): void
    {
        $roll = make(Roll::class);

        for ($i = 1; $i <= self::MAX_PIN_COUNT; $i ++) {
            $this->assertArrayHasKey("pin_{$i}", $roll);
        }
    }

    /** @test */
    public function a_roll_can_return_a_list_of_the_pins_that_it_hit(): void
    {
        $roll = make(Roll::class,
            [
                'pin_1' => true,
                'pin_3' => true,
                'pin_4' => true,
            ]);

        $this->assertCount(3, $roll->knockedPins);
    }
}
