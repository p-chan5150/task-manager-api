<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Validates that the input is actually a valid status
            'status' => ['required', Rule::enum(TaskStatus::class)],
        ];
    }

    protected function passedValidation()
    {
        $task = $this->route('task'); // Grabs the task from the {task} route parameter
        $next = TaskStatus::from($this->status);

        // This calls the match logic you wrote in your Enum!
        if (!$task->status->update($next)) {
            abort(response()->json([
                'error' => 'Invalid status progression. You cannot skip or revert status.'
            ], 422));
        }
    }
}
