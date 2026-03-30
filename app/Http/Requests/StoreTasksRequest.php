<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'dueDate' => ['required', 'date', 'after_or_equal:today'],
            'priority' => ['required', Rule::enum(TaskPriority::class)],
            'status'   => ['required', Rule::enum(TaskStatus::class)],

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'due_date' => $this->dueDate
        ]);
    }
}
