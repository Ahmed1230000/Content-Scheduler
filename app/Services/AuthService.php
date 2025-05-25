<?php

namespace App\Services;

use App\Helpers\FlashMessage;
use App\Repositories\AuthRepository;

class AuthService
{
    use FlashMessage;

    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        $user = $this->authRepository->register($data);
        if ($user) {
            $this->message('success', 'Registration successful!');
        } else {
            $this->message('error', 'Registration failed!');
        }
        return $user;
    }

    public function login(array $data)
    {
        $data = request()->only('email', 'password');

        $login = $this->authRepository->login($data);
        if ($login) {
            $this->message('success', 'Login successful!');
        } else {
            $this->message('error', 'Please check your credentials.');
        }
        return $login;
    }

    public function logout()
    {
        $this->authRepository->logout();
        $this->message('success', 'Logout successful!');
    }
}
