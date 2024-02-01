<?php

namespace App\Livewire\Architects\Auth;

use App\Enums\Users\UserTypeEnum;
use App\Services\ResetPasswordService;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
	private ResetPasswordService $resetPasswordService;

	public string $email;

	public function boot()
	{
		$this->resetPasswordService = app()->make(ResetPasswordService::class);
	}

	public function render()
    {
        return view('livewire.architects.auth.forgot-password');
    }

	public function rules()
    {
        return [
			'email' => 'required|email:rfc,dns|exists:users',
        ];
    }

	public function messages()
    {
        return [
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.exists' => 'The :attribute is not in our record.',
        ];
    }

	public function validationAttributes()
    {
        return [
			'email' => 'email address',
        ];
    }

	public function submit()
	{
		$validated = $this->validate();
		$validated['user_type'] = UserTypeEnum::ARCHITECT;
		$response = $this->resetPasswordService->sendResetPassword($validated);
		$data = $response->original;
		if($data['success']){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => $data['message']
			]);
			$this->reset();
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => $data['message']
		]);
	}
}
