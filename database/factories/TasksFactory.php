<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'    => \fake()->sentence(4),
            'due_date' => \fake()->dateTimeBetween('now', '+30 days'),
            'priority' => \fake()->randomElement(['high', 'low', 'medium']),
            'status'   => \fake()->randomElement(['pending', 'in_progress', 'done']),
        ];
    }
}
