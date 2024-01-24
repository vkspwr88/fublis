<?php

namespace App\Providers;

use App\View\Composers;
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
        View::composer('users.includes.header', Composers\ProfileImageComposer::class);
        // View::composer('users.includes.header', Composers\TotalUnreadComposer::class);
        View::composer('users.includes.footer', Composers\SocialMediaComposer::class);
    }
}
