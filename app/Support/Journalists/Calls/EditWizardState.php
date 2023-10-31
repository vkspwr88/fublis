<?php

namespace App\Support\Journalists\Calls;

use Spatie\LivewireWizard\Support\State;

class EditWizardState extends State
{
	public function call(): array
	{
		return $this->forStep('journalist-calls-edit-step');
	}
}
