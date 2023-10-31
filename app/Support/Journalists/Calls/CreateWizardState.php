<?php

namespace App\Support\Journalists\Calls;

use Spatie\LivewireWizard\Support\State;

class CreateWizardState extends State
{
	public function call(): array
	{
		return $this->forStep('journalist-calls-create-step');
		/* return [
			$journalistCallCreateStepState,
		]; */
	}
}
