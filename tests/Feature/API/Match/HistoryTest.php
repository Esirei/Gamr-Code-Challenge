<?php

namespace Tests\Feature\API\Match;

use App\Models\Fixture;
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
            ->assertJsonStructure([['teams' => ['home', 'away'], 'scores' => ['home', 'away'], 'date']]);
    }
}
