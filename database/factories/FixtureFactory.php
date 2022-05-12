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
            'status' => function ($attrs) {
                return match (true) {
                    now()->addMinutes(90)->gt($attrs['date']) => Fixture::FINISHED,
                    now()->gt($attrs['date']) => Fixture::ONGOING,
                    default => Fixture::UPCOMING
                };
            },
        ];
    }

    protected function scoreFactory()
    {
        return fn($attrs) => $this->faker->numberBetween(0, now()->lt($attrs['date']) ? 0 : 10);
    }

    public function upcoming()
    {
        return $this->state([
            'status' => Fixture::UPCOMING,
            'date' => $this->faker->dateTimeBetween('+1 years', '+2 years')
        ]);
    }

    public function finished()
    {
        return $this->state([
            'status' => Fixture::FINISHED,
            'date' => $this->faker->dateTimeBetween('-1 year', '-1 month')
        ]);
    }
}
