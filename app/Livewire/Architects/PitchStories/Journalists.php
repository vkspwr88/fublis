<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Journalists extends Component
{
	use WithPagination, WithoutUrlPagination;

	private PitchStoryService $pitchStoryService;

	public $locations;
	public $publicationTypes;
	public $positions;
	public $categories;
	public string $name = '';
	public $selectedLocation = '';
	public $selectedPubliationTypes = [];
	public $selectedCategories = [];
	public $selectedPositions = [];

	public $associatedPublications;
	public $selectedAssociatedPublication;

	public $selectedJournalist = '';
	public $journalist;
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
		$this->journalist = collect([]);
		$this->mediaKits = collect([]);
		$this->name = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('journalist');
		$this->publicationTypes = PublicationTypeController::getSelected('journalist');
		$this->positions = JournalistPositionController::getSelected('journalist');
		$this->categories = CategoryController::getSelected('journalist');
	}

    public function render()
    {
        return view('livewire.architects.pitch-stories.journalists', [
			'journalists' => $this->pitchStoryService->filterJournalists([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'positions' => $this->selectedPositions,
				'categories' => $this->selectedCategories,
			])->paginate(10),
		]);
    }

	public function search()
	{
		$this->resetPage();
		$this->render();
	}

	#[Renderless]
	public function selectAll($type)
	{
		if($type == 'publication-type'){
			$this->selectedPubliationTypes = $this->publicationTypes->pluck('id');
		}
		elseif($type == 'position'){
			$this->selectedPositions = $this->positions->pluck('id');
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
		$this->selectedPositions = [];
		$this->selectedCategories = [];
		$this->search();
	}

	public function pitchJournalist($journalistId){
		$this->selectedAssociatedPublication = '';
		$this->selectedMediaKit = '';
		$journalist = JournalistController::getJournalistById($journalistId);
		if(!$journalist){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid journalist clicked.'
			]);
			return;
		}
		$this->journalist = $journalist->load([
											'user',
											'publications' => [
												'profileImage',
											],
											'associatedPublications' => [
												'profileImage',
											],
										]);
		$this->selectedJournalist = $journalist->id;
		$this->showMediaKit(true);
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
		$selectedPublication = $this->associatedPublications->find($this->selectedAssociatedPublication);
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "";
		// if(isSubscribed()){
			$this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $selectedPublication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br><a href='" . route('journalist.brand.architect', ['architect' => auth()->user()->architect->slug]) .  "' class='text-purple-800'>" . auth()->user()->name . "</a>";
			// $this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $selectedPublication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
		// }
		$this->dispatch('hide-select-mediakit-modal');
		$this->dispatch('show-send-message-modal');
		$this->dispatch('set-message', [
			'message' => $this->message,
		]);
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
			/* $this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'You are only allowed to do 3 pitches per month.'
			]); */
			$this->dispatch('show-pitch-limit-alert-modal');
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
