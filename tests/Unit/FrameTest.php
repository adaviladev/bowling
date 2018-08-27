<?php

namespace Tests\Unit;

use App\Frame;
use App\Game;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FrameTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_frame_can_make_string_path()
    {
        $frame = create(Frame::class);

        $this->assertEquals("/games/{$frame->game_id}/frames/{$frame->id}", $frame->path());
    }
}
