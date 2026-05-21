<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\BaseRequest;
class UpdateTaskRequest extends BaseRequest
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
            'title' => ['sometimes', 'required', 'string', 'max:255'],

            'description' => ['nullable', 'string'],

            'status' => [
                'sometimes',
                'required',
                'in:pending,in_progress,completed'
            ],

            'priority' => [
                'sometimes',
                'required',
                'in:low,medium,high'
            ],

            'due_date' => ['sometimes', 'required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
