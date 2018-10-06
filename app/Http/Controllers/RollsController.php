<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\RollRequest;
use Illuminate\Http\Request;

class RollsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Game                      $game
     * @param \App\Http\Requests\RollRequest $request
     * @return void
     */
    public function store(Game $game, RollRequest $request)
    {
        $frames = collect($request->get('rolls'));

        $game->calculateScore($frames);
        $game->frames()->saveMany($game->frames);
        $game->frames->each(function ($frame) {
            $frame->rolls()->saveMany($frame->rolls);
        });
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
