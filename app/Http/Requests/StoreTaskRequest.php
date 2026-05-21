<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Requests\BaseRequest;
class StoreTaskRequest extends BaseRequest
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
            'title' => ['required', 'string', 'max:255'],

            'description' => ['nullable', 'string'],

            'status' => [
                'required',
                'in:pending,in_progress,completed'
            ],

            'priority' => [
                'required',
                'in:low,medium,high'
            ],

            'due_date' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }

}
