<?php

namespace App\Providers;

use App\Components;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

		Livewire::component('architect-signup-wizard', Components\Architects\Signup\SignupWizardComponent::class);
		Livewire::component('architect-signup-step', Components\Architects\Signup\Steps\SignupStepComponent::class);
		Livewire::component('architect-signup-email-verification-step', Components\Architects\Signup\Steps\EmailVerificationStepComponent::class);
		Livewire::component('architect-signup-add-company-step', Components\Architects\Signup\Steps\AddCompanyStepComponent::class);
		Livewire::component('architect-signup-success-step', Components\Architects\Signup\Steps\SuccessStepComponent::class);
    }
}
