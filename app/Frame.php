<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($frame) {
            $frame->ballThrows->each->delete();
        });
    }

    protected $fillable = [
        'game_id'
    ];

    public function ballThrows()
    {
        return $this->hasMany(BallThrow::class);
    }

    public function path()
    {
        return "frames/{$this->id}";
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
