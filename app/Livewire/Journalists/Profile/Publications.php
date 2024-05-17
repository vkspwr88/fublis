<?php

namespace App\Livewire\Journalists\Profile;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
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

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount()
	{
		$this->name = '';
		$this->selectedLocation = '';
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('publication');
		$this->publicationTypes = PublicationTypeController::getSelected('publication');
		$this->categories = CategoryController::getSelected('publication');
	}

    public function render()
    {
        return view('livewire.journalists.profile.publications', [
			'publications' => $this->pitchStoryService->filterPublications([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
			])->paginate(10),
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
}
