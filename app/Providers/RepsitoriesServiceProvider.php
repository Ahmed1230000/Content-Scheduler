<?php

namespace App\Providers;

use App\Contracts\RepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\PostService;
use Illuminate\Support\ServiceProvider;

class RepsitoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(PostService::class)
            ->needs(RepositoryInterface::class)
            ->give(PostRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
