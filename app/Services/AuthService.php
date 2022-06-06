<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
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