<?php

namespace App\Livewire\Journalists\EmailPreferences;

use App\Services\EmailPreferenceService;
use Livewire\Component;

// THIS WILL BE THE REVERSE OF SELECTION
// SELECTED MEANS NOT IN RECORD (WANT NOTIFICATION)
// NOT SELECTED MEANS IT IS IN RECORD (DONT WANT NOTIFICATION)

class Index extends Component
{
    public $emailPreferences;
	public $selectedEmailPreferences;

	public function mount()
	{
		$records = EmailPreferenceService::getRecordsByUser('journalist');
		// dd($records);
		$this->emailPreferences = $records['all'];
		$this->selectedEmailPreferences = $records['selected'];
	}

    public function render()
    {
        return view('livewire.journalists.email-preferences.index');
    }

    public function save()
	{
		// dd($this->selectedEmailPreferences);

		$response = EmailPreferenceService::updateJournalist($this->selectedEmailPreferences);
		$this->dispatch('alert', $response);
	}
}
