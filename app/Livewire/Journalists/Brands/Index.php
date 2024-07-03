<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Services\BrandService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Index extends Component
{
	use WithPagination, WithoutUrlPagination;

	private BrandService $brandService;

	public $selectedLocation = '';
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public string $name = '';
	public $locations;
	public $categories;
	public $mediaKitTypes;

	public function boot()
	{
		$this->brandService = app()->make(BrandService::class);
	}

	public function mount()
	{
		// $this->locations = LocationController::getAll();
		$this->locations = LocationController::getSelected('company');
		$this->categories = CategoryController::getSelected('company');
		//$this->mediaKitTypes = MediaKitController::getAll();
	}

    public function render()
    {
        return view('livewire.journalists.brands.index', [
			'brands' => $this->brandService->filterAllBarnds([
				'name' => $this->name,
				'location' => $this->selectedLocation,
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
		if($type == 'category'){
			$this->selectedCategories = $this->categories->pluck('id');
		}
	}

	public function clear()
	{
		$this->name = '';
		$this->selectedLocation = '';
		//$this->selectedMediaKitTypes = [];
		$this->selectedCategories = [];
		$this->search();
	}
}
