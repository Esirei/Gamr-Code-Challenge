<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    const UPCOMING = 'upcoming';
    const ONGOING = 'ongoing';
    const FINISHED = 'finished';

    protected $casts = [
        'date' => 'datetime',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    protected function scopeTeamId(Builder $builder, int $teamId)
    {
        $builder->where(fn ($query) => $query->where('home_team_id', $teamId)->orWhere('away_team_id', $teamId));
    }
}
