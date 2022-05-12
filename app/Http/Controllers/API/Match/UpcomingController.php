<?php

namespace App\Http\Controllers\API\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\UpcomingResource;
use App\Models\Fixture;

class UpcomingController extends Controller
{
    public function __invoke()
    {
        $result = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereStatus(Fixture::UPCOMING)
            ->orderBy('date')
            ->get();

        return UpcomingResource::collection($result);
    }
}
