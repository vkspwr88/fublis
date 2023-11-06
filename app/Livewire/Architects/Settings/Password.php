<?php

namespace App\Livewire\Architects\Settings;

use App\Services\Architects\SettingService;
use Livewire\Component;

class Password extends Component
{
	public string $password = '';
	public string $newPassword = '';
	public string $newPassword_confirmation = '';

	private SettingService $settingService;

	public function mount()
	{
		$this->password = '';
		$this->newPassword = '';
		$this->newPassword_confirmation = '';
	}

	public function boot()
	{
		$this->settingService = app()->make(SettingService::class);
	}

    public function render()
    {
        return view('livewire.architects.settings.password');
    }

	public function refresh()
	{
		$this->mount();
		$this->resetValidation();
	}

	public function rules()
	{
		return [
			'password' => 'required|current_password:web',
			'newPassword_confirmation' => 'required',
			'newPassword' => 'required|confirmed',
		];
	}

	public function messages()
	{
		return [
			'password.required' => 'Enter the :attribute.',
			'password.current_password' => 'The :attribute is incorrect.',
			'newPassword_confirmation.required' => 'Enter the :attribute.',
			'newPassword.required' => 'Enter the :attribute.',
			'newPassword.confirmed' => 'The :attribute does not match.',
		];
	}

	public function validationAttributes()
	{
		return [
			'password' => 'current password',
			'newPassword_confirmation' => 'new password',
			'newPassword' => 'confirm new password',
		];
	}

	public function update()
	{
		$validated = $this->validate();
		//dd($validated);
		if($this->settingService->updatePassword($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated the password.'
			]);
			return to_route('architect.account.profile.setting.password');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating the password. Please try again or contact support.'
		]);
	}
}
