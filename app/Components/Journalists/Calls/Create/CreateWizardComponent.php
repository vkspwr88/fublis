<?php

namespace App\Components\Journalists\Calls\Create;

use App\Components\Journalists\Calls\Create\Steps;
use App\Support\Journalists\Calls\CreateWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class CreateWizardComponent extends WizardComponent
{
	public function steps() : array
    {
        return [
            Steps\CreateStepComponent::class,
            Steps\PreviewStepComponent::class,
            Steps\SuccessStepComponent::class,
        ];
    }

	public function stateClass(): string
    {
        return CreateWizardState::class;
    }
}
