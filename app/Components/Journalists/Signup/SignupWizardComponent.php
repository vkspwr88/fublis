<?php

namespace App\Components\Journalists\Signup;

use App\Components\Journalists\Signup\Steps;
use App\Support\Journalists\Signup\SignupWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class SignupWizardComponent extends WizardComponent
{
	public function steps() : array
    {
        return [
			//Steps\AddPublicationStepComponent::class,
            Steps\SignupStepComponent::class,
            Steps\EmailVerificationStepComponent::class,
			Steps\AddPublicationStepComponent::class,
			Steps\AddProfileStepComponent::class,
			Steps\SuccessStepComponent::class,
        ];
    }

	public function stateClass(): string
    {
        return SignupWizardState::class;
    }
}
