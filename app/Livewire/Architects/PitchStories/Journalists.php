<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Livewire\Component;

class Journalists extends Component
{
	public $selectedLocation = '';
	public $selectedPubliationTypes = [];
	public $selectedCategories = [];
	public $selectedPositions = [];

	private PitchStoryService $pitchStoryService;

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

    public function render()
    {
        return view('livewire.architects.pitch-stories.journalists', [
			'locations' => LocationController::getAll(),
			'publicationTypes' => PublicationTypeController::getAll(),
			'categories' => CategoryController::getAll(),
			'positions' => JournalistPositionController::getAll(),
			'journalists' => $this->pitchStoryService->filterJournalists([
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
				'positions' => $this->selectedPositions,
			]),
		]);
    }
}
