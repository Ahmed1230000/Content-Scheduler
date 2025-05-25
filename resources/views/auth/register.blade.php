@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold mb-6 text-center text-indigo-600">Create an Account</h2>

    <form method="POST" action="{{ route('register.store') }}" novalidate>
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-1 font-medium text-gray-700">Name</label>
            <input id="name" name="name" type="text" required autofocus
                value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400
                @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block mb-1 font-medium text-gray-700">Email Address</label>
            <input id="email" name="email" type="email" required
                value="{{ old('email') }}"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400
                @error('email') border-red-500 @enderror">
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block mb-1 font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400
                @error('password') border-red-500 @enderror">
            @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block mb-1 font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Select Platforms</label>
            @foreach ($platforms as $platform)
            <div class="flex items-center mb-2">
                <input type="checkbox" id="platform_{{ $platform->id }}" name="platforms[]" value="{{ $platform->id }}"
                    {{ in_array($platform->id, old('platforms', [])) ? 'checked' : '' }}
                    class="mr-2">
                <label for="platform_{{ $platform->id }}" class="text-gray-700">
                    {{ $platform->name }} ({{ $platform->type }})
                </label>
            </div>
            @endforeach
            @error('platforms')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            
            <div class="mt-4">
                {{ $platforms->links() }}
            </div>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-md transition">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-gray-600">
        Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login here</a>
    </p>
</div>
@endsection