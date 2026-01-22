<?php

namespace App\Components\Journalists\Signup\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SuccessStepComponent extends StepComponent
{
	public function stepInfo(): array
	{
		return [
			'title' => 'Download & Invite Stories',
			'subtitle' => 'Pick and invite stories that match your requirements',
		];
	}

	public function render()
	{
		return view('livewire.journalists.signup-wizard.steps.success');
	}

	public function afterSignupRedirect()
	{
		if(session()->has('url.intended')){
			$redirectUrl = session()->get('url.intended');
			session()->forget('url.intended');
			return redirect($redirectUrl);
		}
		return to_route('journalist.media-kit.index');
	}
}
