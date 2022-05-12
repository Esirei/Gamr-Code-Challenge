<?php

namespace App\Http\Resources\Match;

use App\Models\Fixture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Fixture */
class HistoryResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'teams' => [
                'home' => $this->homeTeam,
                'away' => $this->awayTeam,
            ],
            'scores' => [
                'home' => $this->home_team_score,
                'away' => $this->away_team_score,
            ],
            'date' => $this->date,
        ];
    }
}
