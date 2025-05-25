<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostStoreFormRequest;
use App\Http\Requests\PostUpdateFormRequest;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();

        $posts = $this->postService->index(Auth::user(), $filters);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostStoreFormRequest $request)
    {
        $this->postService->store($request->validated());
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = $this->postService->show($id);
        return view('posts.edit', compact('post'));
    }

    public function update(PostUpdateFormRequest $request, $id)
    {
        $this->postService->update($id, $request->validated());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $this->postService->delete($id);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
