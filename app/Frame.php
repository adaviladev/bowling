<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($frame) {
            $frame->rolls->each->delete();
        });
    }

    protected $fillable = [
        'game_id',
        'index',
    ];

    public function rolls()
    {
        return $this->hasMany(Roll::class);
    }

    public function path()
    {
        return "frames/{$this->id}";
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function score()
    {
        return $this->rolls->pluck('pins')->sum();
    }
}
