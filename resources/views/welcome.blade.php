@extends('layouts.app')

@section('content')
<main class="container mx-auto p-6 min-h-[60vh]">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center">

        <!-- Total Posts -->
        <a href="{{ route('posts.index') }}"
            class="bg-white shadow-md rounded-lg p-8 w-full max-w-xs text-center hover:shadow-xl transition duration-300 ease-in-out">
            <h2 class="text-2xl font-bold mb-2">Total Posts</h2>
            <p class="text-5xl font-extrabold text-blue-600">
                {{ \App\Models\Post::count() }}
            </p>
            <p class="mt-4 text-blue-700 font-medium">Click to view all posts</p>
        </a>

        <!-- Total Platforms -->
        <div
            class="bg-white shadow-md rounded-lg p-8 w-full max-w-xs text-center hover:shadow-xl transition duration-300 ease-in-out">
            <h2 class="text-2xl font-bold mb-2">Total Platforms</h2>
            <p class="text-5xl font-extrabold text-blue-600">
                {{ \App\Models\Platform::count() }}
            </p>
            <p class="mt-4 text-gray-600 font-medium">Available platforms</p>
        </div>

        <!-- User's Platforms -->
        <a href="{{ route('user.platform') }}"
            class="bg-white shadow-md rounded-lg p-8 w-full max-w-xs text-center hover:shadow-xl transition duration-300 ease-in-out">
            <h2 class="text-2xl font-bold mb-2">Your Platforms</h2>
            <p class="text-5xl font-extrabold text-blue-600">
                {{ Auth::user()->platforms()->count() }}
            </p>
            <p class="mt-4 text-blue-700 font-medium">Manage your platforms</p>
        </a>
        <a href="{{ route('get.platform') }}"
            class="bg-white shadow-md rounded-lg p-8 w-full max-w-xs text-center hover:shadow-xl transition duration-300 ease-in-out">
            <h2 class="text-2xl font-bold mb-2">Available Platforms</h2>
            <p class="mt-4 text-blue-700 font-medium">Manage platforms</p>
        </a>

    </div>
</main>
@endsection