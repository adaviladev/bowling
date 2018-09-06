<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\GameRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $games = Game::all();

        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\GameRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GameRequest $request): \Illuminate\Http\RedirectResponse
    {
        $game = Game::create([
            'complete' => request('complete'),
            'score' => request('score') ?? 0,
            'user_id' => auth()->id(),
        ]);

        $game->save();

        return redirect($game->path());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Game $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        $rolls = collect($request->get('rolls'));
        $rolls = $rolls->map(function ($roll) {
            return Roll::make($roll);
        });
        $frame = Frame::make(
            [
                'game_id' => $game->id,
            ]
        );
        $game->frames()->save($frame);

        $frame->rolls()->saveMany($rolls);
        foreach ($request->all() as $key => $value) {
            $game->update([
                $key => $value
            ]);
        }

        $game->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Game $game
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Game $game)
    {
        //dd($game->toArray(), auth()->user()->toArray());
        $this->authorize('delete', $game);
        $game->delete();

        return redirect('/games');
    }
}
