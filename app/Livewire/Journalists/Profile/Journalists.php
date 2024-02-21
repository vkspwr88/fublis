<?php

namespace App\Livewire\Journalists\Profile;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Journalists extends Component
{
	use WithPagination;

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

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount()
	{
		$this->name = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getCountries();
		$this->publicationTypes = PublicationTypeController::getAll();
		$this->positions = JournalistPositionController::getAll();
		$this->categories = CategoryController::getAll();
	}

    public function render()
    {
        return view('livewire.journalists.profile.journalists', [
			'journalists' => $this->pitchStoryService->filterJournalists([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'positions' => $this->selectedPositions,
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
		$this->render();
	}
}
