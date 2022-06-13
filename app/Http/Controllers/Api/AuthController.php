<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

    public function changePassword(ChangePasswordRequest $changePasswordRequest, AuthService $authService): JsonResponse
    {
        $user = Auth::user();
        $originalPassword = $changePasswordRequest->originalPassword();
        $password = $changePasswordRequest->password();

        if ($authService->tryChangePassword($user, $originalPassword, $password)) {
            return $this->makeSuccessResponse('Password changed successfully.', []);
        }

        return $this->makeFailureResponse('Failed to changed password.');
    }
}