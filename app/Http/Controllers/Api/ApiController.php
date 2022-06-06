<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function makeSuccessResponse(string $message, array $data): JsonResponse
    {
        $responseData = ['message' => $message,
                         'data'    => $data];

        return response()->json($responseData, 200);
    }

    public function makeFailureResponse(string $message, int $errorCode = 404, array $extraData = null): JsonResponse
    {
        $responseData = ['message' => $message];

        if (!empty($extraData)) {
            $responseData['data'] = $extraData;
        }

        return response()->json($responseData, $errorCode);
    }
} 