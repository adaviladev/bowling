@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Games</h1>
            </div>
        </div>
        @forelse($games as $game)
            <div id="game-{{ $game->id }}" class="row">
                <div class="col-1">{{ $game->id }}</div>
                <div class="col-11">
                    <a href="/games/{{ $game->id }}">Click to view game details</a><span class="pull-right">{{ $game->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @empty
            No games
        @endforelse
    </div>
@endsection