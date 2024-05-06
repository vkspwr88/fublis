<?php

namespace App\Livewire\Journalists\Header;

use App\Services\BrandService;
use App\Services\MediaKitService;
use Livewire\Component;

class Search extends Component
{
	private MediaKitService $mediaKitService;
	private BrandService $brandService;

	public $searchInput;
	public bool $showSearchBox;
	public $mediaKits;
	public $brands;
	public $mobile;

	public function mount($mobile = false)
	{
		$this->showSearchBox = false;
		$this->mediaKits = collect([]);
		$this->brands = collect([]);
		$this->mobile = $mobile;
	}

	public function boot()
	{
		$this->mediaKitService = app()->make(MediaKitService::class);
		$this->brandService = app()->make(BrandService::class);
	}

    public function render()
    {
        return view('livewire.journalists.header.search');
    }

	public function showSearch()
	{
		$this->showSearchBox = true;
	}

	public function search()
	{
		// dd($this->searchInput);
		if($this->searchInput != ''){
			$this->mediaKits = $this->mediaKitService->filterAllMediaKits([
				'name' => $this->searchInput,
				'location' => '',
				'mediaKitTypes' => [],
				'categories' => [],
			]);
			$this->brands = $this->brandService->filterAllBarnds([
				'name' => $this->searchInput,
				'location' => '',
				'categories' => [],
			]);
		}
	}
}
