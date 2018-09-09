<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\GameRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Roll;
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
     * @return Response
     */
    public function create(): Response
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
     * @return Response
     */
    public function show(Game $game): Response
    {
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game  $game
     * @return Response
     */
    public function edit(Game $game): Response
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\GameUpdateRequest $request
     * @param  Game                                $game
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(GameUpdateRequest $request, Game $game): \Symfony\Component\HttpFoundation\Response
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
                'score' => 8
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

        return response([
            'message' => 'Game ' . $game->id . ' has been successfully updated.',
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
