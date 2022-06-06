<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function attemptRegisterUser(string $username, string $email, string $password, string $phone_number): ?User
    {
        $userData = ['username' => $username,
                     'email'    => $email,
                     'password' => Hash::make($password),
                     'phone_number' => $phone_number];

        $user = User::create($userData);

        return $user;
    }

    public function attemptLoginUser(string $username, string $password): ?User
    {
        $credentials = ['username' => $username,
                        'password' => $password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user;
        }

        return null;
    }
} 