<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BallThrow extends Model
{
    public static $scores = [
        '-', 1, 2, 3, 4, 5, 6, 7, 8, 9, '/', 'X'
    ];
    protected $fillable = [
        'frame_id',
        'index',
        'score'
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public static function getSecondScore($score1)
    {
        $score = null;
        if($score1 === 'X') {
            return null;
        }

        return static::$scores[random_int(0, \count(static::$scores) - 2)];
    }
}
