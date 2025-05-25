<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HandleError;

class AuthRepository
{
    use HandleError;

    public function register(array $data)
    {
        return $this->handleError(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            if ($user && isset($data['platforms']) && is_array($data['platforms'])) {
                $user->platforms()->sync($data['platforms']);
            }
            return $user;
        });
    }

    public function login(array $data)
    {
        return $this->handleError(function () use ($data) {
            return Auth::attempt($data);
        });
    }

    public function logout()
    {
        return $this->handleError(function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        });
    }
}
