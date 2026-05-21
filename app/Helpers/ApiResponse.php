<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Success Response
     */
    public static function success(
        string $message = 'Success',
        mixed $data = null,
        int $statusCode = 200
    ): JsonResponse {

        return response()->json([

            'success' => true,

            'status_code' => $statusCode,

            'message' => $message,

            'data' => $data,

        ], $statusCode);
    }

    /**
     * Error Response
     */
    public static function error(
        string $message = 'Something went wrong',
        mixed $errors = null,
        int $statusCode = 400
    ): JsonResponse {

        return response()->json([

            'success' => false,

            'status_code' => $statusCode,

            'message' => $message,

            'errors' => $errors,

        ], $statusCode);
    }

    
}