<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\GameRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Roll;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $games = Game::all();

        return response([
            'games' => $games,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
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
            'complete' => $request->get('complete'),
            'score' => $request->get('score') ?? 0,
            'user_id' => auth()->id(),
        ]);

        $game->save();

        return redirect($game->path());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Game $game
     * @return \Illuminate\View\View
     */
    public function show(Game $game): \Illuminate\View\View
    {
        return view('games.show', [
            'game' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game $game
     * @return \Illuminate\View\View
     */
    public function edit(Game $game): \Illuminate\View\View
    {
        return view('games.edit', [
            'game' => $game,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\GameUpdateRequest $request
     * @param  Game                                $game
     * @return ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        $rolls = collect($request->get('rolls'));
        $rolls = $rolls->map(function ($roll) {
            return Roll::make([
                'pins' => $roll
            ]);
        });
        /** @var Frame $frame */
        $frame = Frame::make(
            [
                'game_id' => $game->id,
                'score' => 8,
                'index' => 1
            ]
        );
        $game->frames()->save($frame);

        $frame->rolls()->saveMany($rolls);

        return response([
            'message' => "Game {$game->id} has been successfully updated.",
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Game $game
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        $game->delete();

        return redirect('/games');
    }
}
