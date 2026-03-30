<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;

    protected $fillable = ['title', 'due_date', 'priority', 'status'];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'priority' => TaskPriority::class,
            'status'   => TaskStatus::class,
        ];
    }

    public function scopeSorted($query)
    {
        // Sort by priority (high → low), then due_date ascending
        return $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderBy('due_date', 'asc');
    }
}
