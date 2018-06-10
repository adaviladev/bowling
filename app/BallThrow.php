<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BallThrow extends Model
{
    protected $fillable = [
        'frame_id',
        'index',
        'score'
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }
}
