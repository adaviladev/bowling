<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    public static $scores = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10
    ];
    protected $fillable = [
        'frame_id',
        'index',
        'pins'
    ];

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }

    public static function getSecondScore($score1)
    {
        if($score1 === 10) {
            return null;
        }

        return static::$scores[random_int(0, \count(static::$scores) - 2)];
    }
}
