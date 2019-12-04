<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Game;
use App\Http\Requests\GameRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Roll;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class GamesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])
             ->except(
                 [
                     'index',
                     'show',
                 ]
             );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $games = Game::all();

        return response(
            [
                'games' => $games,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GameRequest $request
     *
     * @return Response
     */
    public function store(GameRequest $request): Response
    {
        return response([
            'game' => Game::create(
                [
                    'complete' => $request->get('complete', false),
                    'score'    => $request->get('score') ?? 0,
                    'user_id'  => auth()->id(),
                ])
            ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Game $game
     *
     * @return Response
     */
    public function show(Game $game): Response
    {
        return response(
            [
                'game' => $game->load('frames.rolls'),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Game $game
     *
     * @return View
     */
    public function edit(Game $game): View
    {
        return view(
            'games.edit',
            [
                'game' => $game,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GameUpdateRequest $request
     * @param  Game             $game
     *
     * @return ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        $rolls = collect($request->get('rolls'));
        $rolls = $rolls->map(static function ($roll) {
            return Roll::make([
                'pins' => $roll,
            ]);
        });
        /** @var Frame $frame */
        $frame = Frame::make([
            'game_id' => $game->id,
            'score'   => 8,
            'index'   => 1,
        ]);
        $game->frames()
            ->save($frame);

        $frame->rolls()
             ->saveMany($rolls);

        return response([
            'message' => "Game {$game->id} has been successfully updated.",
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Game $game
     *
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     * @throws Exception
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
