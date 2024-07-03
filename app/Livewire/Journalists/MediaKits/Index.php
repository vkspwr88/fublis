<?php

namespace App\Livewire\Journalists\MediaKits;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\MediaKitController;
use App\Services\MediaKitService;
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

	public $selectedLocation = '';
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public string $name = '';
	public $locations;
	public $categories;
	public $mediaKitTypes;

	public function boot()
	{
		$this->mediaKitService = app()->make(MediaKitService::class);
	}

	public function mount()
	{
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('mediakit');
		$this->categories = CategoryController::getSelected('mediakit');
		$this->mediaKitTypes = MediaKitController::getAll();
	}

    public function render()
    {
        return view('livewire.journalists.media-kits.index', [
			'mediaKits' => $this->mediaKitService->filterAllMediaKits([
				'location' => $this->selectedLocation,
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
		$this->selectedLocation = '';
		$this->selectedMediaKitTypes = [];
		$this->selectedCategories = [];
		// $this->reset();
		$this->search();
	}
}
