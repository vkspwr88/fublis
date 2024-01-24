<?php

namespace App\Components\Journalists\Calls\Edit;

use App\Components\Journalists\Calls\Edit\Steps;
use App\Support\Journalists\Calls\EditWizardState;
use Carbon\Carbon;
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
		//dd($this->call->location->name);
        return [
			'journalist-calls-edit-step' => [
				'category' => $this->call->category_id,
				'title' => $this->call->title,
				'description' => $this->call->description,
				'selectedCity' => strtolower($this->call->location->name),
				'selectedPublishFrom' => $this->call->publish_from_id,
				'publication' => $this->call->publication_id,
				'language' => $this->call->language_id,
				'submissionEndsDate' => Carbon::parse($this->call->submission_end_date)->format('d-M-Y'),
				'callId' => $this->call->id,
				'callSlug' => $this->call->slug,
				'journalistSlug' => $this->call->journalist->slug,
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
