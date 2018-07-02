<?php

namespace App\Http\Middleware;

use Closure;

class GameOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->game->user_id != auth()->id()) {
            return redirect('/games');
        }
        return $next($request);
    }
}
