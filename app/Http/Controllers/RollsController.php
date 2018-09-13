<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\RollRequest;
use App\Roll;
use Illuminate\Database\Eloquent\Collection;
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
        $frames = $this->prepareRollsToFrames($request);

        $game->calculateScore($frames);

        ///** @var Frame $frame */
        //$frame = Frame::make([
        //    'score' => 8,
        //]);
        //$game->frames()->save($frame);
        //
        //$frame->rolls()->saveMany($rolls);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    protected function prepareRollsToFrames(Request $request): \Illuminate\Support\Collection
    {
        return collect($request->get('rolls'));
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
