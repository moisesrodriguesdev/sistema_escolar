<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'year' => $this->faker->year,
            'teach_level' => $this->faker->randomElement([Team::MEDIO, Team::FUNDAMENTAL]),
            'serie' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'shift' => $this->faker->randomElement(['Manhã', 'Tarde', 'Noite']),
            'school_id' => School::factory(),
        ];
    }
}
