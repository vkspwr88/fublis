<?php

namespace App\Livewire\Architects\MediaKits;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\MediaKitController;
use App\Services\MediaKitService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Index extends Component
{
	use WithPagination;

	private MediaKitService $mediaKitService;

	public $categories = [];
	public $mediaKitTypes = [];
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public string $name = '';

	public function boot()
	{
		$this->mediaKitService = app()->make(MediaKitService::class);
	}

	public function mount()
	{
		$this->categories = CategoryController::getAll();
		$this->mediaKitTypes = MediaKitController::getAll();
	}

    public function render()
    {
		//$this->selectedMediaKitTypes = $this->isMediaKitCheckedAll ? $this->mediaKitTypes : [];
        return view('livewire.architects.media-kits.index', [
			'mediaKits' => $this->mediaKitService->filterMediaKits([
				'mediaKitTypes' => $this->selectedMediaKitTypes,
				'categories' => $this->selectedCategories,
				'name' => $this->name,
			])->paginate(5),
		]);
    }

	public function search()
	{
		$this->render();
		//dd($this->selectedMediaKitTypes, $this->selectedCategories);
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
		$this->selectedMediaKitTypes = [];
		$this->selectedCategories = [];
		$this->render();
	}
}
