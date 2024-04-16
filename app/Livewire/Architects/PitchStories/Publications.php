<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Publications extends Component
{
	use WithPagination;

	private PitchStoryService $pitchStoryService;

	public $locations;
	public $publicationTypes;
	public $categories;
	public string $name = '';
	public $selectedLocation = '';
	public $selectedPubliationTypes = [];
	public $selectedCategories = [];

	public $associatedPublications;
	public $publication;
	public $selectedJournalist = '';
	public $journalists;
	public $selectedMediaKit = '';
	public $mediaKits;
	public $subject = '';
	public $message = '';

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount()
	{
		$this->associatedPublications = collect([]);
		$this->journalists = collect([]);
		$this->mediaKits = collect([]);
		$this->name = '';
		$this->selectedLocation = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getCountries();
		$this->publicationTypes = PublicationTypeController::getAll();
		$this->categories = CategoryController::getAll();
	}

    public function render()
    {
        return view('livewire.architects.pitch-stories.publications', [
			'publications' => $this->pitchStoryService->filterPublications([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
			])->paginate(5),
		]);
    }

	public function search()
	{
		$this->render();
	}

	#[Renderless]
	public function selectAll($type)
	{
		if($type == 'publication-type'){
			$this->selectedPubliationTypes = $this->publicationTypes->pluck('id');
		}
		elseif($type == 'category'){
			$this->selectedCategories = $this->categories->pluck('id');
		}
	}

	public function clear()
	{
		$this->name = '';
		$this->selectedLocation = '';
		$this->selectedPubliationTypes = [];
		$this->selectedCategories = [];
		$this->render();
	}

	// Show journalists list
	public function showContact(string $publicationId)
	{
		$publication = PublicationController::findById($publicationId);
		if(!$publication){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid publication clicked.'
			]);
			return;
		}
		if(SubscriptionController::checkPremiumPublication($publication)){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Upgrade your plan to pitch premium publication.'
			]);
			return;
		}
		/* if($publication->is_premium && !isSubscribed()){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Upgrade your plan to pitch premium publication.'
			]);
		} */
		$publication->load([
							'journalists' => [
								'position',
								'user',
								'profileImage',
							],
							'associatedJournalists' => [
								'position',
								'user',
								'profileImage',
							],
						]);

		$this->publication = $publication;
		//dd($publication);
		$this->journalists = $publication->journalists->merge($publication->associatedJournalists);
		//dd($this->journalists);
		$this->dispatch('show-select-contact-modal');
	}

	// Show mediakits list
	public function showMediaKit()
	{
		if($this->selectedJournalist == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select a contact.'
			]);
			return;
		}
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
		$journalist = $this->journalists->find($this->selectedJournalist);
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "";
		if(isSubscribed()){
			$this->message = "Hi " . $journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
		}
		$this->dispatch('hide-select-mediakit-modal');
		$this->dispatch('show-send-message-modal');
	}

	// Show success message
	public function showPitchSuccess()
	{
		// dd($this->message);
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
		if($this->pitchStoryService->createPitchStory($this->publication, [
			'journalist' => $this->selectedJournalist,
			'mediaKit' => $this->selectedMediaKit,
			'mediaKitType' => showModelName($mediaKit->story_type),
			'mediaKitSlug' => $mediaKit->slug,
			'mediaKitTitle' => $mediaKit->story->title,
			'subject' => $this->subject,
			'message' => $this->message,
			'publicationId' => $this->publication->id,
		])){
			$this->dispatch('hide-send-message-modal');
			$this->dispatch('show-pitch-publication-success-modal');
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Problem in pitching the story to the publication. Please contact support.'
		]);
	}
}
