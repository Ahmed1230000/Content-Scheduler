<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Handle the incoming request.
     */
    public function logoutForm()
    {
        return view('auth.logout');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'Logout successful!');
    }
}
