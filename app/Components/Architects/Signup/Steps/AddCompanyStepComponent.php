<?php

namespace App\Components\Architects\Signup\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class AddCompanyStepComponent extends StepComponent
{
	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.add-company');
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Add your company',
			'subtitle' => 'Add your company name & location',
		];
	}

	public function add()
	{
		$this->nextStep();
	}
}
