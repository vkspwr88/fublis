<?php

namespace App\Livewire\Common\InviteColleague;

use App\Services\InviteColleagueService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Form extends Component
{
	private InviteColleagueService $inviteColleagueService;

	public $name = '';
	public $email;
	public $sender;
	public $inviteMessage;
	public int $inviteMessageLength = 275;

	/* public function mount()
	{
		$this->inviteMessageLength = 275;
	} */

	public function mount(string $sender)
	{
		$this->sender = $sender;
	}

	public function boot()
	{
		$this->inviteColleagueService = app()->make(InviteColleagueService::class);
	}

    public function render()
    {
		$this->inviteMessage = 'Hi ' . $this->name . ', I\'m stoked to invite you to Fublis! This is an exciting and superbly convenient way for us to collaborate on our PR and marketing efforts. Hope to see you soon on Fublis.';
		$this->characterCount();
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
				Rule::unique('users')->ignore(auth()->id()),
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
			'email.unique' => 'The :attribute is already registerred.',
			'inviteMessage.required' => 'Enter the :attribute.',
			'inviteMessage.max' => 'The :attribute allows only 275 characters.',
		];
	}

	public function validationAttributes()
	{
		return [
			'name' => 'full name',
			'email' => 'email address',
			'inviteMessage' => 'invite message',
		];
	}

	public function submit()
	{
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());
		$validated['type'] = $this->sender;
		//dd($validated);
		if($this->inviteColleagueService->sendInvitation($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully sent the invitation.'
			]);
			$this->reset();
			$this->sender = $validated['type'];
			return;
			//return to_route('journalist.account.profile.invite-colleague');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in sending the invitation. Please try again or contact support.'
		]);
	}
}
