@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ auth()->user()->full_name }}'s Game #{{ $game->id }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2>Frames</h2>
            </div>
            <table class="table game-{{ $game->id }}">
                <thead>
                    <tr class="text-center">
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($game->frames as $frame)
                        <td>
                            @foreach($frame->rolls as $roll)
                                <span class="p0 col-6 score-{{ $roll->pins }}">{{ $roll->pins }}</span>
                            @endforeach
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            <div class="col-2">
                {{ $game->created_at->toFormattedDateString() }}
            </div>
        </div>

    </div>
@endsection