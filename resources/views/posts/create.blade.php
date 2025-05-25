@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Create New Post</h2>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror" required>
            @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1">Content</label>
            <textarea name="content" id="content" rows="5"
                class="w-full border rounded px-3 py-2 @error('content') border-red-500 @enderror" required
                maxlength="280">{{ old('content', $post->content ?? '') }}</textarea>
            <div id="charCount" class="text-sm text-gray-600 mt-1">0 / 280</div>
            @error('content')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image_url" class="block font-semibold mb-1">Image (URL or Upload)</label>
            <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}"
                class="w-full border rounded px-3 py-2 @error('image_url') border-red-500 @enderror" placeholder="Image URL">
            @error('image_url')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="scheduled_time" class="block font-semibold mb-1">Scheduled Time</label>
            <input type="datetime-local" name="scheduled_time" id="scheduled_time" value="{{ old('scheduled_time') }}"
                class="w-full border rounded px-3 py-2 @error('scheduled_time') border-red-500 @enderror" required>
            @error('scheduled_time')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select name="status" id="status"
                class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror" required>
                @foreach (\App\Enums\PostStatus::cases() as $status)
                <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>
                    {{ ucfirst($status->name) }}
                </option>
                @endforeach
            </select>
            @error('status')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Platforms</label>
            @php
            $platforms = auth()->user()->platforms;
            @endphp
            @foreach($platforms as $platform)
            <label class="inline-flex items-center mr-4 mb-2">
                <input type="checkbox" name="platforms[]" value="{{ $platform->id }}"
                    {{ (is_array(old('platforms')) && in_array($platform->id, old('platforms'))) ? 'checked' : '' }}
                    class="form-checkbox">
                <span class="ml-2">{{ ucfirst($platform->name) }}</span>
            </label>
            @endforeach
            @error('platforms')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit"
            class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition">
            Create Post
        </button>
        <a href="{{ route('dashboard') }}" class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Dashboard
        </a>

        <a href="{{ route('posts.index') }}"
            class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Go to Posts
        </a>
    </form>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('charCount');
        const maxLength = 280;

        function updateCount() {
            const length = textarea.value.length;
            charCount.textContent = `${length} / ${maxLength}`;
        }

        textarea.addEventListener('input', updateCount);

        // Initialize count on page load
        updateCount();
    });
</script>