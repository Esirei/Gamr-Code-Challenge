<?php

namespace App\Http\Controllers\API\Match;

use App\Http\Controllers\Controller;
use App\Models\Fixture;

class UpcomingController extends Controller
{
    public function __invoke()
    {
        $result = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereStatus(Fixture::UPCOMING)
            ->orderBy('date')
            ->get()
            ->map(function (Fixture $fixture) {
                return [
                    'teams' => [
                        'home' => $fixture->homeTeam,
                        'away' => $fixture->awayTeam,
                    ],
                    'date' => $fixture->date,
                ];
            });

        return $result;
    }
}
