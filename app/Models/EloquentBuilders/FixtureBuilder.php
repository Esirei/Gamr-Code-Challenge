<?php

namespace App\Models\EloquentBuilders;

use Illuminate\Database\Eloquent\Builder;

class FixtureBuilder extends Builder
{
    public function teamId(int $teamId)
    {
        return $this->where(fn ($query) => $query->where('home_team_id', $teamId)->orWhere('away_team_id', $teamId));
    }
}
