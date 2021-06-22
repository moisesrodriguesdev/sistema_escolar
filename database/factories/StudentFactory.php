<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'cellphone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
            'birth' => '1998-09-04',
            'gender' => $this->faker->randomElement(['male', 'female']),
            'team_id' => Team::factory()
        ];
    }
}
