@extends('layouts.app')

@section('content')
    <h1 id="game-{{ $game->id }}">Game {{ $game->id }}</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">1</th>
            <th scope="col">2</th>
            <th scope="col">3</th>
            <th scope="col">4</th>
            <th scope="col">5</th>
            <th scope="col">6</th>
            <th scope="col">7</th>
            <th scope="col">8</th>
            <th scope="col">9</th>
            <th scope="col">10</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($game->frames as $frame)
                <td>{{ $frame->score }}</td>
            @endforeach
            <td>{{ $game->score }}</td>
        </tr>
        </tbody>
    </table>
@endsection