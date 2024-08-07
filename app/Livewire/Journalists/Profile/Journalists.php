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

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount()
	{
		$this->name = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('journalist');
		$this->publicationTypes = PublicationTypeController::getSelected('journalist');
		$this->positions = JournalistPositionController::getSelected('journalist');
		$this->categories = CategoryController::getSelected('journalist');
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
}
