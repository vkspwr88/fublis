<?php

namespace App\Components\Architects\Signup\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SignupStepComponent extends StepComponent
{
	public function render()
	{
		//dd($this->step, $this->steps);
		return view('livewire.architects.signup-wizard.steps.signup');
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Your details',
			'subtitle' => 'Please provide your name and email',
		];
	}

	public function signup()
	{
		$this->nextStep();
	}
}
