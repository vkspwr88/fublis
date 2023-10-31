<?php

namespace App\Components\Journalists\Calls\Edit\Steps;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Services\CallService;
use Spatie\LivewireWizard\Components\StepComponent;

class PreviewStepComponent extends StepComponent
{
	private CallService $callService;

	public function boot()
	{
		$this->callService = app()->make(CallService::class);
	}

	public function render()
	{
		$call = $this->state()->call();
		return view('livewire.journalists.calls.edit-wizard.steps.preview', [
			'category' => CategoryController::findById($call['category']),
			'title' => $call['title'],
			'description' => $call['description'],
			'location' => LocationController::findById($call['location']),
			'publication' => PublicationController::findById($call['publication']),
			'language' => LanguageController::findById($call['language']),
			'submissionEndsDate' => $call['submissionEndsDate'],
		]);
	}

	public function update()
	{
		//dd($this->state()->call());
		if($this->callService->editInviteStory($this->state()->call())){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'Invite story updated successfully.'
			]);
			return to_route('journalist.call.view', ['call' => $this->state()->call()['callId']]);
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating invite story. Please contact support.'
		]);
	}
}
