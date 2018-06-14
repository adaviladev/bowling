<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($game) {
            $game->frames->each->delete();
        });
    }

    protected $fillable = [
        'user_id'
    ];

    public function ballThrows()
    {
        return $this->hasManyThrough(BallThrow::class, Frame::class);
    }

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }

    public function path()
    {
        return "/games/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
