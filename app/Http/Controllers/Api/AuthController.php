<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{
    public function login(LoginRequest $loginRequest, AuthService $authService): JsonResponse
    {
        $username = $loginRequest->username();
        $password = $loginRequest->password();

        $user = $authService->attemptLoginUser($username, $password);

        if (is_null($user)) {
            return $this->makeFailureResponse('Wrong Credentials!', 401);
        }

        $token = $user->createApiToken();

        $data = ['user'  => $user->toArray(),
                 'token' => $token->plainTextToken];

        return $this->makeSuccessResponse('Welcome!', $data);
    }
}