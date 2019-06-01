<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\RollRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RollsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Game        $game
     * @param RollRequest $request
     * @return void
     */
    public function store(Game $game, RollRequest $request): void
    {
        $rolls = collect($request->get('rolls'));

        $game->calculateScore($rolls);

        $game->frames()->saveMany($game->frames);
        $game->frames->each(static function (Frame $frame) {
            $frame->rolls()->saveMany($frame->rolls);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int    $id
     * @return Response
     */
    //public function update(Request $request, $id)
    //{
    //    //
    //}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    //public function destroy($id)
    //{
    //    //
    //}
}
