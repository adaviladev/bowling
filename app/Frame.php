<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $fillable = [
        'game_id',
        'score',
    ];
    public function path()
    {
        return "/games/{$this->game_id}/frames/{$this->id}";
    }

    public function rolls()
    {
        return $this->hasMany(Roll::class);
    }
}
