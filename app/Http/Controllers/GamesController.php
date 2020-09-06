<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Requests\GameRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Roll;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api'])
            ->except([
                'index',
                'show',
            ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $games = Game::all();

        return response([
            'games' => $games,
        ], Response::HTTP_OK);
    }

    public function store(GameRequest $request): Response
    {
        return response([
            'game' => Game::create([
                'complete' => $request->get('complete', false),
                'score' => $request->get('score') ?? 0,
                'user_id' => auth()->id(),
            ]),
        ], Response::HTTP_CREATED);
    }

    public function show(Game $game): Response
    {
        return response([
            'game' => $game->load('rolls'),
        ], Response::HTTP_OK);
    }

    public function update(GameUpdateRequest $request, Game $game): Response
    {
        $rolls = collect($request->get('rolls'));
        $rolls = $rolls->map(static function ($roll) {
            return Roll::make([
                'pins' => $roll,
            ]);
        });
        $game->rolls()
            ->saveMany($rolls);

        return response([
            'message' => "Game {$game->id} has been successfully updated.",
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse|Redirector
     *
     * @throws AuthorizationException
     */
    public function destroy(Game $game)
    {
        $this->authorize('delete', $game);
        $game->delete();

        return response([
            'message' => "Game #{$game->id} successfully deleted.",
        ], Response::HTTP_OK);
    }
}
