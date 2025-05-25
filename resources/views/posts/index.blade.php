@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Posts</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('posts.create') }}" class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Create New Post
    </a>
    <a href="{{ route('dashboard') }}" class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Dashboard
    </a>

    <form method="GET" action="{{ route('posts.index') }}" class="mb-6 flex flex-wrap gap-2 items-center">
        <select name="filter[status]" class="border px-2 py-1 rounded">
            <option value="">All Status</option>
            <option value="draft" {{ request('filter.status') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="scheduled" {{ request('filter.status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
            <option value="published" {{ request('filter.status') == 'published' ? 'selected' : '' }}>Published</option>
        </select>

        <input type="date" name="filter[from_date]" value="{{ request('filter.from_date') }}" class="border px-2 py-1 rounded" />
        <input type="date" name="filter[to_date]" value="{{ request('filter.to_date') }}" class="border px-2 py-1 rounded" />

        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">Filter</button>
    </form>

    @if($posts->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($posts as $post)
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-5 flex flex-col justify-between hover:shadow-md transition-shadow duration-200">
            <div>
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 mb-1">
                    <strong>Scheduled:</strong> 
                    {{ $post->scheduled_time ? $post->scheduled_time->format('Y-m-d H:i') : '-' }}
                </p>
                <p class="text-gray-600 capitalize mb-4">
                    <strong>Status:</strong> {{ $post->status }}
                </p>
            </div>
            <div class="mt-auto flex space-x-4">
                <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 hover:underline">Edit</a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

    @else
    <p>No posts found.</p>
    @endif
</div>
@endsection
