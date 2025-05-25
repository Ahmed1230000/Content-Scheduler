@extends('layouts.app')

@section('title', 'User Platforms')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Your Platforms</h1>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($userPlatforms as $platform)
        <div class="p-4 border rounded shadow flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold">{{ $platform->name }}</h2>
                <p>Type: {{ $platform->type }}</p>
                <p>Status:
                    @if($platform->pivot->active)
                    <span class="text-green-600 font-bold">Active</span>
                    @else
                    <span class="text-red-600 font-bold">Inactive</span>
                    @endif
                </p>
            </div>

            {{-- زر إلغاء الاشتراك --}}
            <form action="{{ route('platform.unsubscribe') }}" method="POST" class="mt-4">
                @csrf
                {{-- لو method غير POST مثلا DELETE استخدم @method('DELETE') --}}
                <input type="hidden" name="platforms[]" value="{{ $platform->id }}">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded w-full transition">
                    Unsubscribe
                </button>
            </form>
        </div>
        @empty
        <p>No platforms assigned.</p>
        @endforelse
    </div>

    <a href="{{ route('dashboard') }}" class="inline-block mt-4 mb-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Dashboard
    </a>

    <a href="{{ route('posts.index') }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Go to Posts
    </a>
</div>
@endsection
