<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
    public function definition(): array
    {
        return [

            // faker doesnt work on laravel 12 on railway but for some reason works on my 13.2.0  spent 3 hours on this I want to go to sleep
            'title'     => 'Complete task #' . rand(100, 999),
            'due_date'  => now()->addDays(rand(1, 30))->format('Y-m-d'),
            'priority'  => ['low', 'medium', 'high'][rand(0, 2)],
            'status'    => ['pending', 'in_progress', 'done'][rand(0, 2)],
        ];
    }
}
