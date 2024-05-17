<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\Journalists\CallController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Carbon\Carbon;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

// #[Lazy]
class Calls extends Component
{
	use WithPagination;

	private PitchStoryService $pitchStoryService;

	public $locations;
	public $publicationTypes;
	public $deadline;
	public $selectedDeadline;
	public $categories;
	public string $name = '';
	public $selectedLocation = '';
	public $selectedPubliationTypes = [];
	public $selectedCategories = [];

	public $associatedPublications;
	public $selectedAssociatedPublication;

	public $journalists = [];
	public $selectedCall = '';
	public $call;
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
		$this->selectedLocation = '';
		// $this->selectedDeadline = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('call');
		$this->publicationTypes = PublicationTypeController::getSelected('call');
		$this->categories = CategoryController::getSelected('call');
	}

    public function render()
    {
        return view('livewire.architects.pitch-stories.calls', [
			'calls' => $this->pitchStoryService->filterCalls([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'deadline' => $this->selectedDeadline,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
			])->paginate(10),
		]);
    }

	public function search()
	{
		if($this->deadline){
			$this->selectedDeadline = Carbon::parse($this->deadline);
		}
		// $this->selectedDeadline = $this->deadline != '' ? Carbon::parse($this->deadline) : '';
		//dd($this->deadline, Carbon::parse($this->deadline));
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
		$this->selectedDeadline = '';
		$this->selectedPubliationTypes = [];
		$this->selectedCategories = [];
		$this->render();
	}

	// Show mediakits list
	public function showMediaKit(string $callId)
	{
		$call = CallController::findById($callId);
		if(!$call){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid call clicked.'
			]);
			return;
		}
		$this->selectedCall = $callId;
		$this->call = $call->load([
								'journalist' => [
									'publications',
									'user',
								],
								'publication'
							]);
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
			$this->message = "Hi " . $this->journalist->user->name . ",<br><br>I'm writing to you about our latest story <a href='" . route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) . "' class='text-purple-800'>" . $mediaKit->story->title . "</a> for your consideration.<br><br>" . getProjectBrief($mediaKit) . "<br><br>It would be great to have it published in " . $this->call->publication->name . ". I would be happy to share any more information that you might need.<br><br>Regards,<br><a href='" . route('journalist.brand.architect', ['architect' => auth()->user()->architect->slug]) .  "' class='text-purple-800'>" . auth()->user()->name . "</a>";
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
