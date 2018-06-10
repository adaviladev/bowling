<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
