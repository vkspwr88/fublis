<?php

namespace App\Livewire\Journalists\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email;
	public string $password;

    public function render()
    {
        return view('livewire.journalists.auth.login');
    }

	public function rules()
    {
        return [
			'email' => 'required|email:rfc,dns|exists:users',
			'password' => 'required',
        ];
    }

	public function messages()
    {
        return [
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.exists' => 'The :attribute is not in our record.',
			'password.required' => 'Enter the :attribute.',
			//'password.min' => 'The :attribute must be atleast 8 characters.',
        ];
    }

	public function validationAttributes()
    {
        return [
			'email' => 'email address',
			'password' => 'password',
        ];
    }

	public function login()
	{
		$validated = $this->validate();

		if(!Auth::validate($validated)){
            return $this->addError('password', trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($validated);

        Auth::login($user);

		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'You have successfully logged in.'
		]);

		return to_route('home');
	}
}
