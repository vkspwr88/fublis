<?php

namespace App\Livewire\Common\InviteColleague;

use App\Services\InviteColleagueService;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Form extends Component
{
	private InviteColleagueService $inviteColleagueService;

	public $name;
	public $email;
	public $inviteMessage;
	public int $inviteMessageLength = 275;

	/* public function mount()
	{
		$this->inviteMessageLength = 275;
	} */

	public function boot()
	{
		$this->inviteColleagueService = app()->make(InviteColleagueService::class);
	}

    public function render()
    {
        return view('livewire.common.invite-colleague.form', [
			'inviteMessageLength' => $this->inviteMessageLength,
		]);
    }

	//#[Renderless]
	public function characterCount()
	{
		$this->inviteMessageLength = 275 - str()->length($this->inviteMessage);
		//dd($this->inviteMessageLength, $this->inviteMessage);
	}

	public function rules()
	{
		return [
			'name' => 'required',
			'email' => [
				'required',
				'email:rfc,dns',
			],
			'inviteMessage' => 'required|max:275',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Enter the :attribute.',
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'inviteMessage.required' => 'Enter the :attribute.',
			'inviteMessage.max' => 'The :attribute allows only 275 characters.',
		];
	}

	public function validationAttributes()
	{
		return [
			'name' => 'full name',
			'email' => 'amail address',
			'inviteMessage' => 'invite message',
		];
	}

	public function submit()
	{
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());
		//dd($validated);
		if($this->inviteColleagueService->sendInvitation($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully sent the invitation.'
			]);
			$this->reset();
			return;
			//return to_route('journalist.account.profile.invite-colleague');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in sending the invitation. Please try again or contact support.'
		]);
	}
}
