@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold mb-6 text-center text-indigo-600">Login to Your Account</h2>

    <form method="POST" action="{{ route('login.store') }}" novalidate>
        @csrf

        <div class="mb-5">
            <label for="email" class="block mb-1 font-medium text-gray-700">Email Address</label>
            <input id="email" name="email" type="email" required autofocus
                value="{{ old('email') }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400
                @error('email') border-red-500 @enderror">
            @error('error')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-1 font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400
                @error('password') border-red-500 @enderror">
            @error('error')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-md transition">
            Login
        </button>
    </form>

    <p class="mt-6 text-center text-gray-600">
        Don't have an account? <a href="{{ route('register.form') }}" class="text-indigo-600 hover:underline">Register here</a>
    </p>
</div>
@endsection