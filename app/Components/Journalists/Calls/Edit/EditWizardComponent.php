<?php

namespace App\Components\Journalists\Calls\Edit;

use App\Components\Journalists\Calls\Edit\Steps;
use App\Support\Journalists\Calls\EditWizardState;
use Spatie\LivewireWizard\Components\WizardComponent;

class EditWizardComponent extends WizardComponent
{
	public $call;

	public function mount($call)
	{
		$this->call = $call;
	}

    public function initialState(): array
    {
        return [
			'journalist-calls-edit-step' => [
				'category' => $this->call->category_id,
				'title' => $this->call->title,
				'description' => $this->call->description,
				'location' => $this->call->location_id,
				'publication' => $this->call->publication_id,
				'language' => $this->call->language_id,
				'submissionEndsDate' => $this->call->submission_end_date,
				'callId' => $this->call->id,
			],
        ];
    }


	public function steps() : array
    {
        return [
            Steps\EditStepComponent::class,
            Steps\PreviewStepComponent::class,
        ];
    }

	public function stateClass(): string
    {
        return EditWizardState::class;
    }
}
