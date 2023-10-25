<?php

namespace App\Support\Architects\Signup;

use Spatie\LivewireWizard\Support\State;

class SignupWizardState extends State
{
	public function guest(): array
	{
		$architectSignupStepState = $this->forStep('architect-signup-step');
		return [
			'email' => $architectSignupStepState['email'],
		];
	}
}
