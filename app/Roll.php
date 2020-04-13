<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    protected $fillable = [
        'game_id',
        'index',
        'pins',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function getKnockedPinsAttribute()
    {
        return collect($this->attributes)
            ->filter(static function ($attribute, $index) {
                return preg_match('/pin_(([1-9]{1})|10)$/', $index) && $attribute;
            });
    }
}
