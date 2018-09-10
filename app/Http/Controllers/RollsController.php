<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Roll;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RollsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Game                 $game
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Game $game, Request $request)
    {
        $rolls = collect($request->get('rolls'))->map(function ($pins) {
            return Roll::make([
                'pins' => $pins
            ]);
        });

        /** @var Frame $frame */
        $frame = Frame::make([
            'score' => 8,
        ]);
        $game->frames()->save($frame);

        $frame->rolls()->saveMany($rolls);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    //{
    //    //
    //}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    //{
    //    //
    //}
}
