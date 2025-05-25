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

            activity('auth')
                ->causedBy($user)
                ->withProperties([
                    'email' => $user->email,
                    'platforms' => $data['platforms'] ?? []
                ])
                ->log('User registered');

            return $user;
        });
    }

    public function login(array $data)
    {
        return $this->handleError(function () use ($data) {
            $attempt = Auth::attempt($data);

            if ($attempt) {
                $user = Auth::user();
                activity('auth')
                    ->causedBy($user)
                    ->withProperties(['email' => $user->email])
                    ->log('User logged in');
            }

            return $attempt;
        });
    }

    public function logout()
    {
        return $this->handleError(function () {
            $user = Auth::user();

            activity('auth')
                ->causedBy($user)
                ->withProperties(['email' => $user?->email])
                ->log('User logged out');

            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        });
    }
}
