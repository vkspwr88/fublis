<?php

namespace App\Components\Architects\Signup;

use App\Components\Architects\Signup\Steps;
use App\Support\Architects\Signup\SignupWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class SignupWizardComponent extends WizardComponent
{
	public function steps() : array
    {
        return [
            Steps\SignupStepComponent::class,
            Steps\EmailVerificationStepComponent::class,
			Steps\AddCompanyStepComponent::class,
			Steps\SuccessStepComponent::class,
        ];
    }

	public function stateClass(): string
    {
        return SignupWizardState::class;
    }
}
