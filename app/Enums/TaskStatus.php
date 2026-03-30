<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';

    // Status can only progress: pending → in_progress → done
    public function update(self $new): bool
    {
        return match ($this) {
            self::PENDING     => $new === self::IN_PROGRESS,
            self::IN_PROGRESS => $new === self::DONE,
            self::DONE        => false,
        };
    }
}
