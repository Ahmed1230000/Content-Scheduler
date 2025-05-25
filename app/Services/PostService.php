<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Helpers\FlashMessage;
use Illuminate\Support\Facades\Auth;

class PostService
{
    use FlashMessage;

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index($user, array $filters = [], $perPage = 10)
    {
        return $this->postRepository->getFilteredPostsForUser($user, $filters, $perPage);
    }

    public function store(array $data)
    {
        $post = $this->postRepository->store($data);
        if ($post) {
            $this->message('success', 'Post created successfully.');
        } else {
            $this->message('error', 'Failed to create post.');
        }
        return $post;
    }

    public function show($id)
    {
        return $this->postRepository->show($id);
    }

    public function update($id, array $data)
    {
        $post = $this->postRepository->update($id, $data);
        if ($post) {
            $this->message('success', 'Post updated successfully.');
        } else {
            $this->message('error', 'Failed to update post.');
        }
        return $post;
    }

    public function delete($id)
    {
        $deleted = $this->postRepository->delete($id);
        if ($deleted) {
            $this->message('success', 'Post deleted successfully.');
        } else {
            $this->message('error', 'Failed to delete post.');
        }
        return $deleted;
    }
}
