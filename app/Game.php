<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'user_id',
        'score'
    ];

    public function path()
    {
        return '/games/' . $this->id;
    }

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
}
