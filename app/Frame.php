<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Frame
 * @package App
 *
 * @property Collection|Roll[] $rolls
 */
class Frame extends Model
{
    protected $casts = [
        'index' => 'integer',
    ];

    protected $fillable = [
        'index',
        'game_id',
    ];
    public function path()
    {
        return "/api/games/{$this->game_id}/frames/{$this->id}";
    }

    public function rolls()
    {
        return $this->hasMany(Roll::class);
    }
}
