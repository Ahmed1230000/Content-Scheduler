<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GetUserPlatformController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.sotre');

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => view('welcome'))->name('dashboard');
    Route::resource('/posts', PostController::class);
    Route::get('/user/platform', [GetUserPlatformController::class, 'getUserPlatform'])->name('user.platform');
    Route::get('/platforms', [GetUserPlatformController::class, 'getNotHavePlatfrom'])->name('get.platform');
    Route::post('/subscribe/platform', [GetUserPlatformController::class, 'subscribeToPlatform'])->name('platform.subscribe');
    Route::post('/unsubscribe/platform', [GetUserPlatformController::class, 'unsubscribeFromPlatform'])->name('platform.unsubscribe');
});
