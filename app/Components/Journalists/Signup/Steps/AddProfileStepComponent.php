<?php

namespace App\Components\Journalists\Signup\Steps;

use App\Services\JournalistService;
use Illuminate\Support\Facades\Validator;
use Spatie\LivewireWizard\Components\StepComponent;
use App\Http\Controllers;

class AddProfileStepComponent extends StepComponent
{
	public $position;
	public $linkedinProfile;
	public $publishedArticleLink;
	public $publishingPlatformLink;

	private JournalistService $journalistService;

	public function boot()
	{
		$this->journalistService = app()->make(JournalistService::class);
	}

	public function render()
	{
		return view('livewire.journalists.signup-wizard.steps.add-profile', [
			'positions' => Controllers\Users\JournalistPositionController::getAll(),
		]);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Authenticate Account',
			'subtitle' => 'Share your profile',
		];
	}

	public function rules()
	{
		return [
			'position' => 'required|exists:journalist_positions,id',
			'linkedinProfile' => 'required|url',
			'publishedArticleLink' => 'required|url',
			'publishingPlatformLink' => 'required|url',
		];
	}

	public function messages()
	{
		return [
			'position.required' => 'Select the :attribute.',
			'position.exists' => 'Select the valid :attribute.',
			'linkedinProfile.required' => 'Enter the :attribute.',
			'linkedinProfile.url' => 'Enter the valid :attribute.',
			'publishedArticleLink.required' => 'Enter the :attribute.',
			'publishedArticleLink.url' => 'Enter the valid :attribute.',
			'publishingPlatformLink.required' => 'Enter the :attribute.',
			'publishingPlatformLink.url' => 'Enter the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'position' => 'platform position',
			'linkedinProfile' => 'linkedin profile link',
			'publishedArticleLink' => 'published article link',
			'publishingPlatformLink' => 'publishing platform profile link',
		];
	}

	public function data()
	{
		return [
			'position' => $this->position,
			'linkedinProfile' => 'http://' . $this->linkedinProfile,
			'publishedArticleLink' => 'http://' . $this->publishedArticleLink,
			'publishingPlatformLink' => 'http://' . $this->publishingPlatformLink,
		];
	}

	public function add()
	{
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		$validated['password'] = $this->state()->guest()['password'];
		$validated['publication'] = $this->state()->publication();
		//dd($validated);
		if($this->journalistService->addJournalist($validated)){
			$this->nextStep();
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created your profile.'
			]);
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating your profile. Please contact support.'
		]);
	}
}
