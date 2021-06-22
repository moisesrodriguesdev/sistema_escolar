<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Colégio Ari de Sá', 'Colégio Farias Brito', 'EEEP Comendador Miguel Gurgel', 'EEEP Jose de Alencar']),
            'address' => $this->faker->address
        ];
    }
}
