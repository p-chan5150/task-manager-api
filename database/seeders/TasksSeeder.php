<?php

namespace Database\Seeders;

use App\Models\Tasks;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tasks::factory()
            ->count(50)
            ->create();

        Tasks::factory()
            ->count(18)
            ->state(new Sequence(
                ['priority' => TaskPriority::LOW],
                ['priority' => TaskPriority::MEDIUM],
                ['priority' => TaskPriority::HIGH],
            ))
            ->create();

        Tasks::factory()
            ->count(18)
            ->state(new Sequence(
                ['status' => TaskStatus::PENDING],
                ['status' => TaskStatus::IN_PROGRESS],
                ['status' => TaskStatus::DONE],
            ))
            ->create();
    }
}
