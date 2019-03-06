<?php

namespace Tests\Unit;

use App\Frame;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_frame_can_make_string_path()
    {
        $frame = create(Frame::class);

        $this->assertEquals("/api/games/{$frame->game_id}/frames/{$frame->id}", $frame->path());
    }

    ///** @test */
    //public function it_shoul_make_one_frame_associated_to_a_game()
    //{
    //    $rolls = make(Roll::class, [], 2);
    //    $game = create(Game::class);
    //
    //    $this->post($game->path(), [
    //        'rolls' => $rolls,
    //    ]);
    //
    //    $this->assertCount(1, $game->frames);
    //}
}
