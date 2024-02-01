<?php

namespace App\Livewire\Journalists\Auth;

use App\Services\ResetPasswordService;
use Livewire\Component;

class ResetPassword extends Component
{
	private ResetPasswordService $resetPasswordService;

	public string $password;
	public string $password_confirmation;
	public string $token;
	public string $email;

	public function boot()
	{
		$this->resetPasswordService = app()->make(ResetPasswordService::class);
	}

	public function mount(string $token, string $email)
	{
		$this->token = $token;
		$this->email = $email;
	}
	
    public function render()
    {
        return view('livewire.journalists.auth.reset-password');
    }

	public function rules()
	{
		return [
			'token' => 'required',
        	'email' => 'required|email:rfc,dns|exists:users',
			'password_confirmation' => 'required',
			'password' => 'required|confirmed',
		];
	}

	public function messages()
	{
		return [
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.exists' => 'The :attribute is not in our record.',
			'password_confirmation.required' => 'Enter the :attribute.',
			'password.required' => 'Enter the :attribute.',
			'password.confirmed' => 'The :attribute does not match.',
		];
	}

	public function validationAttributes()
	{
		return [
			'token' => 'reset token',
			'email' => 'email',
			'password_confirmation' => 'new password',
			'password' => 'confirm new password',
		];
	}

	public function submit()
	{
		$validated = $this->validate();
		// dd($validated);
		$response = $this->resetPasswordService->resetPassword($validated);
		$data = $response->original;
		if($data['success']){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => $data['message']
			]);
			if($data['redirect_url']){
				$this->redirect($data['redirect_url']);
			}
			$this->reset();
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => $data['message']
		]);
	}
}
