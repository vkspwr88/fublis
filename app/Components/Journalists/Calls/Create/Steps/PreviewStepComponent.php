<?php

namespace App\Components\Journalists\Calls\Create\Steps;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Http\Controllers\Users\PublishFromController;
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
		return view('livewire.journalists.calls.create-wizard.steps.preview', [
			'category' => CategoryController::findById($call['category']),
			'title' => $call['title'],
			'submittedBy' => auth()->user()->name,
			'journalistSlug' => auth()->user()->journalist->slug,
			'description' => $call['description'],
			'selectedCity' => $call['selectedCity'],
			'selectedStateName' => $call['selectedStateName'],
			'selectedCountryName' => $call['selectedCountryName'],
			// 'location' => LocationController::findById($call['location']),
			'publishFrom' => PublishFromController::findById($call['selectedPublishFrom']),
			'publication' => PublicationController::findById($call['publication']),
			'language' => LanguageController::findById($call['language']),
			'submissionEndsDate' => $call['submissionEndsDate'],
		]);
	}

	public function create()
	{
		//dd($this->state()->call());
		if($this->callService->createInviteStory($this->state()->call())){
			$this->nextStep();
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'Invite story created successfully.'
			]);
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating invite story. Please contact support.'
		]);
	}
}
