<?php

namespace App\Livewire\Journalists\Brands;

use App\Models\Company;
use App\Services\BrandService;
use Livewire\Component;

class All extends Component
{
	public $selectedCategories = [];
	public $selectLocation = "";

	private BrandService $brandService;

	public function boot()
	{
		$this->brandService = app()->make(BrandService::class);
	}

    public function render()
    {
        return view('livewire.journalists.brands.all', [
			'brands' => $this->brandService->filterAllBarnds([
				'location' => $this->selectLocation,
				'categories' => $this->selectedCategories,
			]),
		]);
    }
}
