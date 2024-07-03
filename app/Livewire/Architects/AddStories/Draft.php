<?php

namespace App\Livewire\Architects\AddStories;

use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\CategoryController;
use Illuminate\Support\Arr;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Draft extends Component
{
	use WithPagination, WithoutUrlPagination;

	public $categories;
	public $mediaKitTypes = [];
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public string $name = '';

	public function mount()
	{
		$this->categories = CategoryController::getAll();
		$this->mediaKitTypes = MediaKitDraftController::getAll();
	}

    public function render()
    {
        return view('livewire.architects.add-stories.draft', [
			'mediaKits' => MediaKitDraftController::filter([
				'mediaKitTypes' => $this->selectedMediaKitTypes,
				'categories' => $this->selectedCategories,
				'name' => $this->name,
			])->paginate(10),
		]);
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

	public function search()
	{
		$this->resetPage();
		$this->render();
	}

	public function clear()
	{
		$this->name = '';
		$this->selectedMediaKitTypes = [];
		$this->selectedCategories = [];
		$this->search();
	}
}
