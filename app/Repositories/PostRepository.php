<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Helpers\HandleError;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostRepository extends BaseRepository implements RepositoryInterface
{
    use HandleError;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
    public function store(array $data)
    {
        return $this->handleError(function () use ($data) {
            $data['user_id'] = Auth::id();
            $post = $this->model->create($data);

            if (array_key_exists('platforms', $data)) {
                $post->platforms()->attach($data['platforms']);
            }

            return $post;
        });
    }

    public function update($id, array $data)
    {
        return $this->handleError(function () use ($id, $data) {
            $post = $this->model->findOrFail($id);
            $post->update($data);

            if (array_key_exists('platforms', $data)) {
                $post->platforms()->sync($data['platforms']);
            }

            return $post;
        });
    }
    public function getFilteredPostsForUser($user, array $filters, $perPage = 10)
    {
        return QueryBuilder::for($user->posts()->getQuery())
            ->allowedFilters([
                AllowedFilter::exact('status'),
                AllowedFilter::scope('from_date'),
                AllowedFilter::scope('to_date'),
            ])
            ->paginate($perPage);
    }
}
