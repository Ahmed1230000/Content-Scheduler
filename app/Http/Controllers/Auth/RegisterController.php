<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Repositories\GetAvailablePlatformsRepository;
use App\Services\AuthService;
use App\Services\GetAvailablePlatformsService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $authService;

    protected $getAvailablePlatformsService;

    public function __construct(
        AuthService $authService,
        GetAvailablePlatformsService $getAvailablePlatformsService
    ) {
        $this->authService = $authService;
        $this->getAvailablePlatformsService = $getAvailablePlatformsService;
    }
    /**
     * Handle the incoming request.
     */

    public function registerForm()
    {
        $platforms = $this->getAvailablePlatformsService->getPlatforms();
        if ($platforms) {
            return view('auth.register', compact('platforms'));
        }
    }
    public function register(RegisterFormRequest $request)
    {
        $user = $this->authService->register($request->validated());

        if ($user) {
            return redirect()->route('login')->with('success', 'Registration successful!');
        }

        return redirect()->back()->withInput()->with('error', 'Registration failed!');
    }
}
