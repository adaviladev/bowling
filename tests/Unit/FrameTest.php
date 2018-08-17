<?php

namespace Tests\Feature;

use App\Frame;
use App\Roll;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FrameTest extends TestCase
{
	use DatabaseMigrations;

    /** @test
     * @throws \Exception
     */
	public function a_frame_should_delete_all_associated_ball_throws_when_it_is_deleted()
	{
        $this->signIn($this->user);

        $game = $this->buildGame();
        $frames = $game->frames;

        $game->delete();

        foreach ($frames as $frame) {
            $this->assertDatabaseMissing('rolls', ['frame_id' => $frame->id]);
        }
	}

	/** @test */
	function a_user_can_update_ball_throws()
	{
        $game = $this->buildGame();

        $pins       = 8;
        $index       = 1;
        $frame_index = 0;

        /** @var Frame $frame */
        $frame = $game->frames[$frame_index];
        $this->patch(
            $frame->path(),
            [
                'index' => $index,
                'pins' => $pins,
            ]
        );

        $this->assertDatabaseHas('rolls', [
            'frame_id' => $frame->id,
            'index' => $index,
            'pins' => $pins
        ]);
	}

    /** @test */
    function it_should_score_a_frame_with_no_pins_as_zero()
    {
        /** @var Frame $frame */
        $frame = create(Frame::class);
        $this->buildFrame(
            $frame,
            [
                'pins1' => 0,
                'pins2' => 0
            ]
        );

        $this->assertEquals(0, $frame->score());
    }

    /** @test */
    public function it_should_score_a_frame_with_two_and_three_pins_as_five()
    {
        /** @var Frame $frame */
        $frame = create(Frame::class);
        $this->buildFrame(
            $frame,
            [
                'pins1' => 2,
                'pins2' => 3
            ]
        );

        $this->assertEquals(5, $frame->score());
    }

    /** @test */
    public function it_should_score_a_frame_with_three_and_seven_pins_as_a_spare()
    {
        /** @var Frame $frame */
        $frame = create(Frame::class);
        $this->buildFrame(
            $frame,
            [
                'pins1' => 3,
                'pins2' => 7
            ]
        );

        $this->assertEquals(5, $frame->score());
    }
}