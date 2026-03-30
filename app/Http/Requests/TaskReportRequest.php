<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => 'nullable|date|date_format:Y-m-d',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        // Default to today if no date provided
        $data['date'] = $data['date'] ?? now()->toDateString();
        return $data;
    }
}
