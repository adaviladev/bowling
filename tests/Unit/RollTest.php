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
    use RefreshDatabase;

    /** @test */
    public function a_roll_should_be_associated_to_a_frame()
    {
        $frame = create(Frame::class);
        $roll = make(Roll::class);

        $frame->rolls()->save($roll);

        $this->assertDatabaseHas('rolls', ['frame_id' => $roll->frame_id]);
        $this->assertTrue($roll->frame->is($frame));
    }

    /** @test */
    public function a_roll_has_a_record_of_the_pins_that_it_hit()
    {
        $roll = make(Roll::class);

        for ($i = 1; $i <= self::MAX_PIN_COUNT; $i++) {
            $this->assertArrayHasKey("pin_{$i}", $roll);
        }
    }

    /** @test */
    public function a_roll_can_return_a_list_of_the_pins_that_it_hit()
    {
        $roll = make(Roll::class, [
            'pin_1' => true,
            'pin_3' => true,
            'pin_4' => true,
        ]);

        $this->assertCount(3, $roll->pins);
    }
}
