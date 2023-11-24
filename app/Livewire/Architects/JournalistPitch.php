<?php

namespace App\Livewire\Architects;

use App\Http\Controllers\Users\JournalistController;
use App\Services\PitchStoryService;
use Livewire\Component;

class JournalistPitch extends Component
{
	private PitchStoryService $pitchStoryService;

	public $journalist;
	public $selectedJournalist = '';
	public $selectedMediaKit = '';
	public $journalists = [];
	public $mediaKits = [];
	public $subject = '';
	public $message = '';

	public function mount($journalist)
	{
		$this->journalist = $journalist;
		$this->selectedJournalist = $journalist->id;
	}

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

    public function render()
    {
        return view('livewire.architects.journalist-pitch');
    }

	// Show mediakits list
	public function showMediaKit(string $journalistId)
	{
		$journalist = JournalistController::getJournalistById($journalistId);
		if(!$journalist){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid journalist clicked.'
			]);
			return;
		}
		$this->selectedJournalist = $journalistId;
		$this->journalist = $journalist->load(['user', 'publications']);
		$this->mediaKits = auth()->user()
									->architect
									->mediaKits
									->sortByDesc('created_at');
		$this->dispatch('hide-select-contact-modal');
		$this->dispatch('show-select-mediakit-modal');
	}

	// Show mediakits list
	public function showSendMessage()
	{
		if($this->selectedMediaKit == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select a media kit.'
			]);
			return;
		}
		$mediaKit = $this->mediaKits->find($this->selectedMediaKit);
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "Hi " . $this->journalist->user->name . ",\n\nI'm writing to you about our latest story " . $mediaKit->story->title . " for your consideration.\n\n[Concept note] The site located in a rural town of Thottara, 12kms away from Mannarkkad town. Site was a contour site with a level difference of about 10m from West to East with a slope of 1:8m.\n\nIt would be great to have it published in " . $this->journalist->publications[0]->name . ". I would be happy to share any more information that you might need.\n\nRegards,\n" . auth()->user()->name . "";
		$this->dispatch('hide-select-mediakit-modal');
		$this->dispatch('show-send-message-modal');
	}

	// Show success message
	public function showPitchSuccess()
	{
		if($this->pitchStoryService->isStoryPitched($this->selectedJournalist, $this->selectedMediaKit)){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Story is already pitched to this journalist.'
			]);
			return;
		}
		if($this->subject == '' && $this->message == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Enter the subject and message.'
			]);
			return;
		}
		if($this->pitchStoryService->createPitchStory($this->journalist, [
			'journalist' => $this->selectedJournalist,
			'mediaKit' => $this->selectedMediaKit,
			'subject' => $this->subject,
			'message' => $this->message,
		])){
			$this->dispatch('hide-send-message-modal');
			$this->dispatch('show-pitch-success-modal');
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Problem in pitching the story to the journalist. Please contact support.'
		]);
	}
}
