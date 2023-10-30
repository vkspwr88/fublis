<?php

namespace App\Support\Journalists\Signup;

use Spatie\LivewireWizard\Support\State;

class SignupWizardState extends State
{
	public function guest(): array
	{
		$journalistSignupStepState = $this->forStep('journalist-signup-step');
		return [
			'email' => $journalistSignupStepState['email'],
			'password' => $journalistSignupStepState['password'],
		];
	}

	public function publication(): array
	{
		$journalistSignupAddPublicationStepState = $this->forStep('journalist-signup-add-publication-step');
		if($journalistSignupAddPublicationStepState['new']){
			return [
				'new' => true,
				'publicationName' => $journalistSignupAddPublicationStepState['publicationName'],
				'website' => $journalistSignupAddPublicationStepState['website'],
				'location' => $journalistSignupAddPublicationStepState['location'],
				'publicationTypes' => $journalistSignupAddPublicationStepState['checkedPublicationTypes'],
				'categories' => $journalistSignupAddPublicationStepState['checkedCategories'],
			];
		}
		return [
			'new' => false,
			'publication_id' => $journalistSignupAddPublicationStepState['selectedPublication'],
		];
	}
}
