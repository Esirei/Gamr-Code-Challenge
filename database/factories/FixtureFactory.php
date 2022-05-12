<?php

namespace Database\Factories;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class FixtureFactory extends Factory
{
    protected $model = Fixture::class;

    public function definition(): array
    {
        return [
            'home_team_id' => Team::factory(),
            'away_team_id' => Team::factory(),
            'home_team_score' => $this->scoreFactory(),
            'away_team_score' => $this->scoreFactory(),
            'date' => $this->faker->dateTimeBetween('-1 years', '+1 years'),
        ];
    }

    protected function scoreFactory()
    {
        return fn($attrs) => $this->faker->numberBetween(0, now()->lt($attrs['date']) ? 0 : 10);
    }
}
