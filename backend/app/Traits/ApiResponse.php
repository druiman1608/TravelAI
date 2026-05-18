<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function success(mixed $data, string $message = "Operación exitosa", int $code = 200): JsonResponse
    {
        return response()->json(['status' => 'Success', 'message' => $message, 'data' => $data], $code);
    }

    protected function error(string $message = "Operación fallida", int $code = 500): JsonResponse
    {
        return response()->json(['status' => 'Error', 'message' => $message], $code);
    }
}