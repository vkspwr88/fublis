<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Enums\Users\UserTypeEnum;
use App\Models;
use App\Models\User;
use App\Policies;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Models\MediaKit::class => Policies\MediaKitPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
		// Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
			return $user->hasRole('Super Admin') ? true : null;
		});

		ResetPassword::createUrlUsing(function (User $user, string $token) {
			// return 'https://example.com/reset-password?token='.$token;
			if($user->user_type === UserTypeEnum::ARCHITECT){
				return route('architect.reset', ['token' => $token, 'email' => $user->email]);
			}
			if($user->user_type === UserTypeEnum::JOURNALIST){
				return route('journalist.reset', ['token' => $token, 'email' => $user->email]);
			}
		});
    }
}
