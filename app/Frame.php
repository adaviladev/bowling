<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    public function path()
    {
        return "/games/{$this->game_id}/frames/{$this->id}";
    }

    public function rolls()
    {
        return $this->hasMany(Roll::class);
    }
}
