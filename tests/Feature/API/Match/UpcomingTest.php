<?php

namespace Tests\Feature\API\Match;

use App\Models\Fixture;
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
            ->assertJsonStructure([['teams' => ['home', 'away'], 'date']]);
    }
}
