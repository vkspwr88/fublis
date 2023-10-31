<?php

namespace App\Components\Journalists\Calls\Create\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SuccessStepComponent extends StepComponent
{
	public function render()
	{
		return view('livewire.journalists.calls.create-wizard.steps.success');
	}
}
