<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    private Team $team;

    protected function setUp(): void
    {
        parent::setUp();
        $this->team = Team::factory()->create();
    }

    public function testCanCreateTeam()
    {
        $this->assertDatabaseCount(Team::class, 1);
    }

    public function testTeamBelongsToUser()
    {
        $this->assertInstanceOf(User::class, $this->team->user);
    }
}
