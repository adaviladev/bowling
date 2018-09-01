<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'complete',
        'score',
        'user_id',
    ];
    
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        
        self::deleting(function ($game) {
            $game->frames->each->delete();
        });
    }

    public function path()
    {
        return '/games/' . $this->id;
    }

    public function frames()
    {
        return $this->hasMany(Frame::class);
    }
}
