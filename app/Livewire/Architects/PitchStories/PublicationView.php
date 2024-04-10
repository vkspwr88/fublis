<?php

namespace App\Livewire\Architects\PitchStories;

use App\Models\Journalist;
use App\Services\PitchStoryService;
use Livewire\Component;

class PublicationView extends Component
{
	private PitchStoryService $pitchStoryService;

	public $publication;

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
		// dd($this->publication->location->city);
        return view('livewire.architects.pitch-stories.publication-view', [
			'city' => $this->publication->location->city()->first(),
		]);
    }

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount($publication)
	{
		$this->publication = $publication->load([
			'profileImage',
			'location.city.state.country',
			// 'location.state.country',
			'categories',
			'publicationTypes',
			'journalists' => [
				'profileImage',
				'user',
				'position',
				'publications' => [
					'profileImage',
				],
				'associatedPublications' => [
					'profileImage',
				],
			],
			'associatedJournalists' => [
				'profileImage',
				'user',
				'position',
				'publications' => [
					'profileImage',
				],
				'associatedPublications' => [
					'profileImage',
				],
			],
		]);
		// $this->publication->location->state()->dd();
		// dd($this->publication->location, $this->publication->location->state()->first()->country);
		$this->associatedPublications = collect([]);
		$this->journalists = $this->publication->journalists->merge($this->publication->associatedJournalists);
		$this->mediaKits = collect([]);
	}

	// Show journalists list
	public function showContact()
	{
		$this->selectedAssociatedPublication = null;
		$this->selectedModelType = $this->publication;
		$this->dispatch('show-select-contact-modal');
	}

	public function pitchJournalist($journalist){
		$this->selectedJournalist = $journalist;
		$this->showMediaKit(true);
	}

	// Show mediakits list
	public function showMediaKit($checkAssociates = false)
	{
		if($this->selectedJournalist == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select a contact.'
			]);
			return;
		}

		if($checkAssociates){
			$journalist = $this->publication->journalists->find($this->selectedJournalist) ?? $this->publication->associatedJournalists->find($this->selectedJournalist);
			// dd($journalist);
			$this->selectedModelType = $journalist;
			$this->associatedPublications = $journalist->publications->merge($journalist->associatedPublications);
			if($this->associatedPublications->count() > 1){
				$this->dispatch('hide-select-contact-modal');
				$this->dispatch('show-select-publication-modal');
				return;
			}
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
		$journalist = $this->journalists->find($this->selectedJournalist);
		$selectedPublication = $this->selectedAssociatedPublication ? $this->associatedPublications->find($this->selectedAssociatedPublication) : $this->publication;
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "Hi " . $journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $selectedPublication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
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
		$mediaKit = $this->mediaKits->find($this->selectedMediaKit);
		if($this->pitchStoryService->createPitchStory($this->selectedModelType, [
			'journalist' => $this->selectedJournalist,
			'mediaKit' => $this->selectedMediaKit,
			'mediaKitType' => showModelName($mediaKit->story_type),
			'mediaKitSlug' => $mediaKit->slug,
			'mediaKitTitle' => $mediaKit->story->title,
			'subject' => $this->subject,
			'message' => $this->message,
			'publicationId' => $this->selectedAssociatedPublication ?? $this->publication->id,
		])){
			$this->dispatch('hide-send-message-modal');
			if($this->selectedModelType instanceof Journalist){
				$this->dispatch('show-pitch-journalist-success-modal');
			}
			else{
				$this->dispatch('show-pitch-publication-success-modal');
			}
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Problem in pitching the story to the publication. Please contact support.'
		]);
	}
}
