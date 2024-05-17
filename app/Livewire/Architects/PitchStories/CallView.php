<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Services\PitchStoryService;
use Livewire\Component;

class CallView extends Component
{
	private PitchStoryService $pitchStoryService;

	public $call;

	public $associatedPublications;
	public $journalists;
	public $journalist;
	public $mediaKits;

	public $selectedAssociatedPublication;
	public $selectedJournalist;
	public $selectedMediaKit = '';

	public $subject = '';
	public $message = '';

    public function render()
    {
        return view('livewire.architects.pitch-stories.call-view');
    }

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount($call)
	{
		$this->associatedPublications = collect([]);
		$this->journalists = collect([]);
		$this->mediaKits = collect([]);
		$this->call = $call;
	}

	// Show mediakits list
	public function showMediaKit()
	{
		$this->selectedJournalist = $this->call->journalist_id;
		$this->journalist = $this->call->journalist;
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
		$this->message = "";
		// if(isSubscribed()){
			$this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->call->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br><a href='" . route('journalist.brand.architect', ['architect' => auth()->user()->architect->id]) .  "' class='text-purple-800'>" . auth()->user()->name . "</a>";
			// $this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->call->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
		// }
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
		if(SubscriptionController::checkPitchesPerMonth()){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'You are only allowed to do 3 pitches per month.'
			]);
			return;
		}
		if($this->subject == '' || $this->message == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Enter the subject and message.'
			]);
			return;
		}
		$mediaKit = $this->mediaKits->find($this->selectedMediaKit);
		if($this->pitchStoryService->createPitchStory($this->call, [
			'journalist' => $this->selectedJournalist,
			'mediaKit' => $this->selectedMediaKit,
			'mediaKitType' => showModelName($mediaKit->story_type),
			'mediaKitSlug' => $mediaKit->slug,
			'mediaKitTitle' => $mediaKit->story->title,
			'subject' => $this->subject,
			'message' => $this->message,
			'publicationId' => $this->call->publication_id,
		])){
			$this->dispatch('hide-send-message-modal');
			$this->dispatch('show-pitch-call-success-modal');
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Problem in pitching the story to the call. Please contact support.'
		]);
	}
}
