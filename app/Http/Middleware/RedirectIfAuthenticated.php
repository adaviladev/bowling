<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $guard
     */
    public function handle($request, Closure $next, $guard = 'api')
    {
        if (Auth::guard($guard)->check()) {
            return response([
                'message' => 'Already signed in.',
            ], Response::HTTP_FOUND);
        }

        return $next($request);
    }
}
