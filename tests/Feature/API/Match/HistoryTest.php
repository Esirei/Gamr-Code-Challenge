<?php

namespace Tests\Feature\API\Match;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    public function testHistoryApi()
    {
        Fixture::factory(50)->create();

        $this->getJson(route('api.history'))
            ->assertOk()
            ->assertJsonStructure(['data' => [['teams' => ['home', 'away'], 'scores' => ['home', 'away'], 'date']]]);
    }

    public function testUpcomingApiWithDateQuery()
    {
        Fixture::factory(9)
            ->finished()
            ->sequence(
                ['date' => $date = now()->subDays(7)],
                ['date' => now()->subDays(14)],
                ['date' => now()->subMonth()],
            )
            ->create();

        $this->getJson(route('api.history', ['date' => $date->toDateString()]))
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function testUpcomingApiWithTeamQuery()
    {
        $team = Team::factory()->create();

        Fixture::factory(10)
            ->finished()
            ->sequence(
                [],
                ['home_team_id' => $team->id],
                [],
                ['away_team_id' => $team->id],
                [],
            )
            ->create();

        $this->getJson(route('api.history', ['team' => $team->id]))
            ->assertOk()
            ->assertJsonCount(4, 'data');
    }
}
