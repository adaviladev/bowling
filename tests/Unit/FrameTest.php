<?php

namespace Tests\Feature;

use App\Frame;
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
            $this->assertDatabaseMissing('ball_throws', ['frame_id' => $frame->id]);
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

        $this->assertDatabaseHas('ball_throws', [
            'frame_id' => $frame->id,
            'index' => $index,
            'pins' => $pins
        ]);
	}

}