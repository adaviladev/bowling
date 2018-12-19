<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roll extends Model
{
    protected $fillable = [
        'pins'
    ];

    public function getPinsAttribute()
    {
        return collect($this->attributes)
            ->filter(function ($attribute, $index) {
                return preg_match('/pin_(([1-9]{1})|10)$/', $index) && $attribute;
            });
    }

    public function frame()
    {
        return $this->belongsTo(Frame::class);
    }
}
