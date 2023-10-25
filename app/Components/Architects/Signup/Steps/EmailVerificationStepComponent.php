<?php

namespace App\Components\Architects\Signup\Steps;

use App\Services\ArchitectService;
use Illuminate\Support\Arr;
use Spatie\LivewireWizard\Components\StepComponent;

class EmailVerificationStepComponent extends StepComponent
{
	public array $otp = [
		'1' => '',
		'2' => '',
		'3' => '',
		'4' => '',
	];
	public int $maxLength = 1;

	private ArchitectService $architectService;

	public function boot(){
		$this->architectService = app()->make(ArchitectService::class);
	}

	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.email-verification', [
			'email' => $this->state()->guest()['email'],
		]);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Verify your account',
			'subtitle' => 'Confirm your email',
		];
	}

	public function rules()
    {
        return [
			'otp.1' => 'required|integer|min:0|max:9',
			'otp.2' => 'required|integer|min:0|max:9',
			'otp.3' => 'required|integer|min:0|max:9',
			'otp.4' => 'required|integer|min:0|max:9',
        ];
    }

	public function messages()
    {
        return [
            'otp.*.required' => 'Enter the 4 digit OTP.',
            'otp.*.integer' => 'Enter the 4 digit OTP.',
            'otp.*.min' => 'Enter the 4 digit OTP.',
            'otp.*.max' => 'Enter the 4 digit OTP.',
        ];
    }

	public function verify()
	{
		$this->validate();
		$otp = Arr::join($this->otp, '');
		$guest = $this->architectService->verifyGuestEmail($otp);
		if($guest){
			$this->nextStep();
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully verified your email address.'
			]);
			return;
		}
		$this->addError('otp.1', 'OTP is either invalid or expired.');
	}

	public function resend()
	{
		$this->architectService->resendVerificationEmail();
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Please check your email address for the OTP.'
		]);
	}
}
