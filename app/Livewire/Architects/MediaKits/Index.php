<?php

namespace App\Livewire\Architects\MediaKits;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\MediaKitController;
use App\Http\Controllers\Users\PublicationController;
use App\Services\MediaKitService;
use App\Services\PitchStoryService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Index extends Component
{
	use WithPagination, WithoutUrlPagination;

	private MediaKitService $mediaKitService;
	private PitchStoryService $pitchStoryService;

	#[Url]
    public $page = 1;

	public $categories;
	public $mediaKitTypes = [];
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public string $name = '';

	public $selectedAssociatedPublication;
	public $associatedPublications;
	public $publication;
	public $selectedJournalist;
	public $journalists;
	public $selectedMediaKit;
	public $mediaKits;
	public $subject;
	public $message;

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
		$this->mediaKitService = app()->make(MediaKitService::class);
	}

	public function mount()
	{
		$this->selectedAssociatedPublication = '';
		$this->selectedJournalist = '';
		$this->selectedMediaKit = '';
		$this->subject = '';
		$this->message = '';
		$this->associatedPublications = collect([]);
		$this->journalists = collect([]);
		$this->mediaKits = collect([]);

		$this->categories = CategoryController::getSelected('mediakit', true);
		$this->mediaKitTypes = MediaKitController::getAll();
	}

    public function render()
    {
		//$this->selectedMediaKitTypes = $this->isMediaKitCheckedAll ? $this->mediaKitTypes : [];
        return view('livewire.architects.media-kits.index', [
			'ownMediaKits' => $this->mediaKitService->filterMediaKits([
				'mediaKitTypes' => $this->selectedMediaKitTypes,
				'categories' => $this->selectedCategories,
				'name' => $this->name,
			])->paginate(10),
		]);
    }

	public function search()
	{
		$this->resetPage();
		$this->render();
		//dd($this->selectedMediaKitTypes, $this->selectedCategories);
	}

	#[Renderless]
	public function selectAll($type)
	{
		if($type == 'media-kit'){
			$this->selectedMediaKitTypes = Arr::mapWithKeys($this->mediaKitTypes, function (array $item, int $key) {
				return [$key => $item['id']];
			});
		}
		elseif($type == 'category'){
			$this->selectedCategories = $this->categories->pluck('id');
		}
	}

	public function clear()
	{
		$this->name = '';
		$this->selectedMediaKitTypes = [];
		$this->selectedCategories = [];
		$this->search();
	}

	// Show publications list
	public function pitchPublications($selectedMediaKit)
	{
		$this->selectedMediaKit = $selectedMediaKit;
		$this->associatedPublications = $this->pitchStoryService->filterPublications([
			'name' => '',
			'location' => '',
			'publicationTypes' => [],
			'categories' => [],
		]);
		if($this->associatedPublications->count() > 1){
			$this->dispatch('show-select-publication-modal');
		}
		// dd('working');
	}

	// Show journalists list
	public function showMediaKit()
	{
		if($this->selectedAssociatedPublication == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select a publication.'
			]);
			return;
		}
		if($this->selectedMediaKit && $this->selectedAssociatedPublication && $this->journalists->count() == 0){
			$publication = PublicationController::findById($this->selectedAssociatedPublication);
			if(!$publication){
				$this->dispatch('alert', [
					'type' => 'warning',
					'message' => 'Invalid publication clicked.'
				]);
				return;
			}
			if(SubscriptionController::checkPremiumPublication($publication)){
				$this->dispatch('show-pitch-premium-alert-modal');
				return;
			}
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
			$this->journalists = $publication->journalists->merge($publication->associatedJournalists);
			$this->dispatch('hide-select-publication-modal');
			$this->dispatch('show-select-contact-modal');
			return;
		}
		if($this->selectedJournalist == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Select a contact.'
			]);
			return;
		}
		$mediaKit = MediaKitController::getMediaKitById($this->selectedMediaKit) ;
		if(!$mediaKit){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid media kit.'
			]);
			return;
		}
		$journalist = $this->journalists->find($this->selectedJournalist);
		$this->subject = 'New ' . showModelName($mediaKit->story_type) . ' | ' . $mediaKit->story->title;
		$this->message = "";
		// if(isSubscribed()){
			$this->message = "Hi " . $journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br><a href='" . route('journalist.brand.architect', ['architect' => auth()->user()->architect->slug]) .  "' class='text-purple-800'>" . auth()->user()->name . "</a>";
			// $this->message = "Hi " . $journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br>" . auth()->user()->name . "";
		// }
		$this->dispatch('hide-select-contact-modal');
		$this->dispatch('show-send-message-modal');
		$this->dispatch('set-message', [
			'message' => $this->message,
		]);
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
		$mediaKit = MediaKitController::getMediaKitById($this->selectedMediaKit) ;
		if(!$mediaKit){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid media kit.'
			]);
			return;
		}
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
