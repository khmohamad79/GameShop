<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{
    public function register(RegisterRequest $registerReqeust, AuthService $authService): JsonResponse
    {
        $username = $registerReqeust->username();
        $email = $registerReqeust->email();
        $password = $registerReqeust->password();
        $phone_number = $registerReqeust->phone_number();

        $user = $authService->attemptRegisterUser($username, $email, $password, $phone_number);

        if (is_null($user)) {
            return $this->makeFailureResponse('Failed to create new user!', 403);
        }

        $token = $user->createApiToken();

        $data = ['user'  => $user->toArray(),
                 'token' => $token->plainTextToken];

        return $this->makeSuccessResponse('User Created Successfully', $data);
    }

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