<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Game.
 *
 * @property Collection|Roll[] $rolls
 */
class Game extends Model
{
    protected const FRAMES_PER_GAME = 10;

    protected $casts = [
        'user_id' => 'int',
        'complete' => 'boolean',
        'score' => 'integer',
    ];

    protected $fillable = [
        'complete',
        'score',
        'user_id',
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function ($game) {
            $game->rolls->each->delete();
        });
    }

    public function calculateScore(Collection $rolls)
    {
        $sum = 0;
        $roll = 0;

        for ($frameIndex = 1; $frameIndex <= self::FRAMES_PER_GAME; $frameIndex++) {
            if ($this->isStrike($rolls, $roll)) {
                $sum += 10 + $this->getStrikeBonus($rolls, $roll);
                $roll++;
            } elseif ($this->isSpare($rolls, $roll)) {
                $sum += 10 + $this->getSpareBonus($rolls, $roll);
                $roll += 2;
            } else {
                $sum += $this->getDefaultFrameScore($rolls, $roll);
                $this->rolls->push(
                        Roll::make([
                            'pins' => $rolls[$roll],
                        ])
                    )
                    ->push(
                        Roll::make([
                            'pins' => $rolls[$roll + 1],
                        ])
                    );
                $roll += 2;
            }
        }

        $this->score = $sum;

        return $this;
    }

    public function path(): string
    {
        return '/api/games/' . $this->id;
    }

    public function rolls()
    {
        return $this->hasMany(Roll::class);
    }

    private function isStrike(Collection $rolls, int $roll): bool
    {
        return $rolls[$roll] === 10;
    }

    private function isSpare(Collection $rolls, int $roll): bool
    {
        return $rolls[$roll] + $rolls[$roll + 1] === 10;
    }

    private function getStrikeBonus(Collection $rolls, int $roll)
    {
        return $rolls[$roll + 1] + $rolls[$roll + 2];
    }

    private function getSpareBonus(Collection $rolls, int $roll)
    {
        return $rolls[$roll + 2];
    }

    protected function getDefaultFrameScore(Collection $rolls, int $roll): int
    {
        return $rolls[$roll] + $rolls[$roll + 1];
    }
}
