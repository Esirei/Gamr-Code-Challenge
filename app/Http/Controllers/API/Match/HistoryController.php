<?php

namespace App\Http\Controllers\API\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\HistoryResource;
use App\Models\Fixture;

class HistoryController extends Controller
{
    public function __invoke()
    {
        $result = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereStatus(Fixture::FINISHED)
            ->orderBy('date', 'desc')
            ->get();

        return HistoryResource::collection($result);
    }
}
