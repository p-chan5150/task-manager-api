<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Tasks>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // TODO: make faker source from enums
        return [
            'title'      => $this->faker->sentence(4),
            'due_date'   => $this->faker->datetimebetween('now', '+30 days'),
            'priority'   => $this->faker->randomElement(['high', 'low', 'medium']),
            'status'     => $this->faker->randomElement(['pending', 'in_progress', 'done']),
        ];
    }
}
