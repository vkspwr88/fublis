<?php

namespace App\Components\Journalists\Signup\Steps;

use App\Enums\Users\UserTypeEnum;
use App\Services\JournalistService;
use Illuminate\Http\Request;
use Spatie\LivewireWizard\Components\StepComponent;

class SignupStepComponent extends StepComponent
{
	public string $name;
	public string $email;
	public string $password;

	private JournalistService $journalistService;

	public function render()
	{
		return view('livewire.journalists.signup-wizard.steps.signup');
	}

	public function boot(){
		$this->journalistService = app()->make(JournalistService::class);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Your details',
			'subtitle' => 'Name and email',
		];
	}

	public function rules()
    {
        return [
            'name' => 'required|min:3',
			'email' => 'required|email:rfc,dns|unique:users,email',
			'password' => 'required|min:8',
        ];
    }

	public function messages()
    {
        return [
            'name.required' => 'Enter the :attribute.',
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.unique' => 'The :attribute is already registerred.',
			'password.required' => 'Enter the :attribute.',
			'password.min' => 'The :attribute must be atleast 8 characters.',
        ];
    }

	public function validationAttributes()
    {
        return [
            'name' => 'full name',
			'email' => 'email address',
			'password' => 'password',
        ];
    }

	public function signup(Request $request)
	{
		$validated = $this->validate();
		$validated['ip_address'] = $request->getClientIp();
		$validated['user_type'] = UserTypeEnum::JOURNALIST;

		if($this->journalistService->registerGuest($validated)){
			$this->nextStep();
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'Please check your email address for the OTP.'
			]);
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in signing up new user. Please contact support.'
		]);
	}
}
