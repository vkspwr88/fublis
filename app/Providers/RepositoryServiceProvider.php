<?php

namespace App\Providers;

use App\Interfaces;
use App\Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Interfaces\BlogRepositoryInterface::class, Repositories\BlogRepository::class);
        $this->app->bind(Interfaces\BlogCategoryRepositoryInterface::class, Repositories\BlogCategoryRepository::class);
        $this->app->bind(Interfaces\BlogIndustryRepositoryInterface::class, Repositories\BlogIndustryRepository::class);
        $this->app->bind(Interfaces\BlogTagRepositoryInterface::class, Repositories\BlogTagRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
