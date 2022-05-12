<?php

namespace Tests\Feature\API\Match;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpcomingTest extends TestCase
{
    use RefreshDatabase;

    public function testUpcomingApi()
    {
        Fixture::factory(50)->create();

        $this->getJson(route('api.upcoming'))
            ->assertOk()
            ->assertJsonStructure(['data' => [['teams' => ['home', 'away'], 'date']]]);
    }

    public function testUpcomingApiWithDateQuery()
    {
        Fixture::factory(9)
            ->upcoming()
            ->sequence(
                ['date' => $date = now()->addDays(7)],
                ['date' => now()->addDays(14)],
                ['date' => now()->addMonth()],
            )
            ->create();

        $this->getJson(route('api.upcoming', ['date' => $date->toDateString()]))
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function testUpcomingApiWithTeamQuery()
    {
        $team = Team::factory()->create();

        Fixture::factory(10)
            ->upcoming()
            ->sequence(
                [],
                ['home_team_id' => $team->id],
                [],
                ['away_team_id' => $team->id],
                [],
            )
            ->create();

        $this->getJson(route('api.upcoming', ['team' => $team->id]))
            ->assertOk()
            ->assertJsonCount(4, 'data');
    }
}
