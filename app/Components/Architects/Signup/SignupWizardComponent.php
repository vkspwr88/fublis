<?php

namespace App\Components\Architects\Signup;

use App\Components\Architects\Signup\Steps;
use App\Support\Architects\Signup\SignupWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class SignupWizardComponent extends WizardComponent
{
	/* public $step;

	public function mount(string $step)
    {
        $this->step = $step;
		dd($step);
    } */

	public function steps() : array
    {
        return [
			//Steps\AddCompanyStepComponent::class,
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
