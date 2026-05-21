<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ApiResponse;

class BaseRequest extends FormRequest
{
    /**
     * Custom Validation Response
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(

            ApiResponse::error(
                'Validation failed',
                $validator->errors(),
                422
            )

        );
    }
}