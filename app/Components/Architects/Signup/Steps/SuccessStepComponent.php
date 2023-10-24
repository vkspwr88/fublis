<?php

namespace App\Components\Architects\Signup\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SuccessStepComponent extends StepComponent
{
	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.success');
	}
}
