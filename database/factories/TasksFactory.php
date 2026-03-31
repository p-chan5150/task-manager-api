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
        $faker = \Faker\Factory::create();
        return [
            'title'    => $faker->sentence(4),
            'due_date' => $faker->dateTimeBetween('now', '+30 days'),
            'priority' => $faker->randomElement(['high', 'low', 'medium']),
            'status'   => $faker->randomElement(['pending', 'in_progress', 'done']),
        ];
    }
}
