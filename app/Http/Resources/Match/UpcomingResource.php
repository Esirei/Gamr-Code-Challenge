<?php

namespace App\Http\Resources\Match;

use App\Models\Fixture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Fixture */
class UpcomingResource extends JsonResource
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
            'date' => $this->date,
        ];
    }
}
