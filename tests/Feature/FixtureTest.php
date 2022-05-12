<?php

namespace Tests\Feature;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FixtureTest extends TestCase
{
    use RefreshDatabase;

    private Fixture $fixture;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fixture = Fixture::factory()->create();
    }

    public function testCanCreateFixture()
    {
        $this->assertDatabaseCount(Fixture::class, 1);
    }

    public function testFixtureBelongsToTeams()
    {
        $this->assertInstanceOf(Team::class, $this->fixture->homeTeam);
        $this->assertInstanceOf(Team::class, $this->fixture->awayTeam);
    }
}
