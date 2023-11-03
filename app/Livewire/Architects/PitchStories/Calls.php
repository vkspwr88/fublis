<?php

namespace App\Livewire\Architects\PitchStories;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Livewire\Component;

class Calls extends Component
{
	public $selectedLocation = '';
	public $selectedPubliationTypes = [];
	public $selectedCategories = [];

	private PitchStoryService $pitchStoryService;

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

    public function render()
    {
        return view('livewire.architects.pitch-stories.calls', [
			'locations' => LocationController::getAll(),
			'publicationTypes' => PublicationTypeController::getAll(),
			'categories' => CategoryController::getAll(),
			'calls' => $this->pitchStoryService->filterCalls([
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
			]),
		]);
    }
}
