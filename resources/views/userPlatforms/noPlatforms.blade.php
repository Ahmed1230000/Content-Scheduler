@extends('layouts.app')

@section('title', 'Available Platforms')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold mb-6 text-center text-indigo-600">Available Platforms You Are Not Subscribed To</h2>

    @if ($userNoHavePlatform->isEmpty())
    <p class="text-center text-gray-700">You are subscribed to all available platforms.</p>
    @else
    <ul class="space-y-4">
        @foreach ($userNoHavePlatform as $platform)
        <li class="border rounded p-4 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-semibold">{{ $platform->name }}</h3>
                <p class="text-gray-600">{{ $platform->type }}</p>
            </div>
            <form action="{{ route('platform.subscribe') }}" method="POST">
                @csrf
                <input type="hidden" name="platforms[]" value="{{ $platform->id }}">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                    Subscribe
                </button>
            </form>

        </li>
        @endforeach
    </ul>
    @endif

    <div class="mt-6 text-center">
        <a href="{{ route('user.platform') }}" class="text-indigo-600 hover:underline">Back to My Platforms</a>
    </div>
</div>
@endsection