<?php

namespace App\Http\Controllers\API\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\UpcomingResource;
use App\Models\Fixture;
use Illuminate\Http\Request;

class UpcomingController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereStatus(Fixture::UPCOMING)
            ->when($request->query('date'), fn($query, $date) => $query->whereDate('date', $date))
            ->when($request->query('team'), fn ($query, $team) => $query->teamId($team))
            ->orderBy('date')
            ->get();

        return UpcomingResource::collection($result);
    }
}
