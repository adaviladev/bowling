<?php

namespace App\Policies;

use App\Game;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the game.
     */
    //public function view(User $user, Game $game)
    //{
    //    //
    //}

    /**
     * Determine whether the user can create games.
     */
    //public function create(User $user)
    //{
    //    //
    //}

    /**
     * Determine whether the user can update the game.
     */
    //public function update(User $user, Game $game)
    //{
    //    //
    //}

    /**
     * Determine whether the user can delete the game.
     */
    public function delete(User $user, Game $game)
    {
        return $user->id === $game->user_id;
    }
}
