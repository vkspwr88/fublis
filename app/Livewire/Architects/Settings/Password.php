<?php

namespace App\Livewire\Architects\Settings;

use Livewire\Component;

class Password extends Component
{
	public string $password;
	public string $newPassword;
	public string $confirmNewPassword;

    public function render()
    {
        return view('livewire.architects.settings.password');
    }

	public function refresh()
	{
		$this->mount();
	}

	public function rules()
	{
		return [
			'password' => 'required',
			'newPassword' => 'required',
			'confirmNewPassword' => 'required',
		];
	}

	public function messages()
	{
		return [
			'password.required' => 'Enter the :attribute.',
			'newPassword.required' => 'Enter the :attribute.',
			'confirmNewPassword.required' => 'Enter the :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'password' => 'current password',
			'newPassword' => 'new password',
			'confirmNewPassword' => 'confirm new password',
		];
	}

	public function update()
	{
		$validated = $this->validate();
		dd($validated);
	}
}
