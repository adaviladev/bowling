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

    public function rolls()
    {
        return $this->hasManyThrough(Roll::class, Frame::class);
    }

    public function frames()
    {
        return $this->hasMany(Frame::class)
            ->orderBy('index');
    }

    public function path()
    {
        return '/games/' . $this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function score()
    {
        $this->score = $this->rolls->pluck('pins')->sum();
        $this->save();
    }
}
