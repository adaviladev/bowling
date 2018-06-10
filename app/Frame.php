<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'game_id'
    ];

    public function ballThrows()
    {
        return $this->hasMany(BallThrow::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
