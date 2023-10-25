<?php

namespace App\Components\Architects\Signup\Steps;

use App\Enums\Users\UserTypeEnum;
use App\Services\ArchitectService;
use Illuminate\Http\Request;
use Spatie\LivewireWizard\Components\StepComponent;

class SignupStepComponent extends StepComponent
{
	public string $name;
	public string $email;
	public string $password;

	private ArchitectService $architectService;

	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.signup');
	}

	public function boot(){
		$this->architectService = app()->make(ArchitectService::class);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Your details',
			'subtitle' => 'Please provide your name and email',
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
		$validated['user_type'] = UserTypeEnum::ARCHITECT;

		if($this->architectService->registerGuest($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'Please check your email address for the OTP.'
			]);
			$this->nextStep();
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in signing up new user. Please contact support.'
		]);
	}
}
