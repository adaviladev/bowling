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
            @foreach($game->frames as $frame)
                <div class="col-1">
                    @foreach($frame->ballThrows as $ballThrow)
                        <span class="score-{{ $ballThrow->score }}">{{ $ballThrow->score }}</span>
                    @endforeach
                </div>
            @endforeach
            <div class="col-2">
                {{ $game->created_at->diffForHumans() }}
            </div>
            <!-- /.col-2 -->
        </div>

    </div>
@endsection