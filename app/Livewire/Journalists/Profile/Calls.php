<?php

namespace App\Livewire\Journalists\Profile;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Services\PitchStoryService;
use Carbon\Carbon;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
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

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

	public function mount()
	{
		$this->name = '';
		$this->selectedLocation = '';
		$this->selectedDeadline = '';
		$this->locations = LocationController::getAll();
		$this->publicationTypes = PublicationTypeController::getAll();
		$this->categories = CategoryController::getAll();
	}

    public function render()
    {
        return view('livewire.journalists.profile.calls', [
			'calls' => $this->pitchStoryService->filterCalls([
				'name' => $this->name,
				'location' => $this->selectedLocation,
				'deadline' => $this->selectedDeadline,
				'publicationTypes' => $this->selectedPubliationTypes,
				'categories' => $this->selectedCategories,
			])->paginate(5),
		]);
    }

	public function search()
	{
		$this->selectedDeadline = Carbon::parse($this->deadline);
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
}
