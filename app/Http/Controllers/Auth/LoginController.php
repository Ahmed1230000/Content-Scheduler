<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Handle the incoming request.
     */
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(LoginFormRequest $request)
    {
        $user = $this->authService->login($request->validated());
        if ($user) {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }
        return redirect()->back()->withInput()->with('error', 'Login failed!');
    }
}
