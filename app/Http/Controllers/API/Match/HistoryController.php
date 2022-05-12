<?php

namespace App\Http\Controllers\API\Match;

use App\Http\Controllers\Controller;
use App\Models\Fixture;

class HistoryController extends Controller
{
    public function __invoke()
    {
        $result = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereStatus(Fixture::FINISHED)
            ->orderBy('date', 'desc')
            ->get()
            ->map(function (Fixture $fixture) {
                return [
                    'teams' => [
                        'home' => $fixture->homeTeam,
                        'away' => $fixture->awayTeam,
                    ],
                    'scores' => [
                        'home' => $fixture->home_team_score,
                        'away' => $fixture->away_team_score,
                    ],
                    'date' => $fixture->date,
                ];
            });

        return $result;
    }
}
