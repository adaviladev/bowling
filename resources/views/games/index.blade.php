@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Games</h1>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Details</th>
                <th scope="col">Score</th>
                <th scope="col">Date Played</th>
            </tr>
            </thead>
            <tbody>
                @forelse($games as $game)
                    <tr id="game-{{ $game->id }}">
                        <th scope="row">{{ $game->id }}</td>
                        <td>
                            <a href="/games/{{ $game->id }}">Click to view game details</a>
                        </td>
                        <td>{{ $game->score }}</td>
                        <td>{{ $game->created_at }}</td>
                    </tr>
                @empty
                    No games
                @endforelse
            </tbody>
        </table>
    </div>
@endsection