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
            // Validates that the input is a valid status
            'status' => ['required', Rule::enum(TaskStatus::class)],
        ];
    }

    protected function passedValidation()
    {
        $task = $this->route('task');
        $next = TaskStatus::from($this->status);

        // Salls enum update logic
        if (!$task->status->update($next)) {
            abort(response()->json([
                'error' => 'Invalid status progression. You cannot skip or revert status.'
            ], 422));
        }
    }
}
