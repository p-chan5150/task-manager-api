<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // formats the database entries to athere to JSON rules
        return [
            'id' => $this->id,
            'title' => $this->title,
            'dueDate' => $this->due_date,
            'priority' => $this->priority,
            'status' => $this->status,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
