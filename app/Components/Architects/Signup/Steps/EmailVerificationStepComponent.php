<?php

namespace App\Components\Architects\Signup\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class EmailVerificationStepComponent extends StepComponent
{
	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.email-verification');
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Verify your account',
			'subtitle' => 'Confirm your email',
		];
	}

	public function verify()
	{
		$this->nextStep();
	}
}
