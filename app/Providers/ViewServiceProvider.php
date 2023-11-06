<?php

namespace App\Providers;

use App\View\Composers\ProfileComposer;
use App\View\Composers\ProfileImageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('users.includes.header', ProfileImageComposer::class);
    }
}
