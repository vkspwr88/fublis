<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Services\PitchStoryService;
use Livewire\Component;

class JournalistView extends Component
{
	private PitchStoryService $pitchStoryService;

	public $journalist;

	public $associatedPublications;
	public $journalists;
	public $mediaKits;

	public $selectedAssociatedPublication;
	public $selectedModelType;
	public $selectedJournalist;
	public $selectedMediaKit;
	public $subject;
	public $message;

    public function render()
    {
        return view('livewire.architects.pitch-stories.journalist-view');
    }

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount($journalist)
	{
		$this->journalist = $journalist;
		$this->associatedPublications = collect([]);
		$this->journalists = collect([]);
		$this->mediaKits = collect([]);
	}

	// Show mediakits list
	public function showMediaKit($checkAssociates = false)
	{
		if($checkAssociates){
			$this->associatedPublications = $this->journalist->publications->merge($this->journalist->associatedPublications);
			if($this->associatedPublications->count() > 1){
				$this->dispatch('hide-select-contact-modal');
				$this->dispatch('show-select-publication-modal');
				return;
			}
			$this->selectedAssociatedPublication = $this->associatedPublications[0]->id;
		}

		$selectedPublication = $this->associatedPublications->find($this->selectedAssociatedPublication);
		if(SubscriptionController::checkPremiumPublication($selectedPublication)){
			/* $this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Upgrade your plan to pitch premium publication.'
			]); */
			$this->dispatch('hide-select-publication-modal');
			$this->dispatch('show-pitch-premium-alert-modal');
			return;
		}

		$this->mediaKits = auth()->user()
									->architect
									->mediaKits
									->sortByDesc('created_at');
		$this->dispatch('hide-select-contact-modal');
		$this->dispatch('hide-select-publication-modal');
		$this->dispatch('show-select-mediakit-modal');
	}

	// Show send message form
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
		$selectedPublication = $this->associatedPublications->find($this->selectedAssociatedPublication);
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "";
		if(isSubscribed()){
			$this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $selectedPublication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
		}
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
		if($this->pitchStoryService->createPitchStory($this->journalist, [
			'journalist' => $this->selectedJournalist,
			'mediaKit' => $this->selectedMediaKit,
			'mediaKitType' => showModelName($mediaKit->story_type),
			'mediaKitSlug' => $mediaKit->slug,
			'mediaKitTitle' => $mediaKit->story->title,
			'subject' => $this->subject,
			'message' => $this->message,
			'publicationId' => $this->selectedAssociatedPublication,
		])){
			$this->dispatch('hide-send-message-modal');
			$this->dispatch('show-pitch-journalist-success-modal');
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Problem in pitching the story to the journalist. Please contact support.'
		]);
	}
}
