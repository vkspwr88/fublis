<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\CompanyController;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
	use WithPagination;

	public $brand;

	public function mount($brand)
	{
		$this->brand = $brand;
	}

    public function render()
    {
		$this->brand = CompanyController::loadModel($this->brand);
        return view('livewire.journalists.brands.profile', [
			'mediaKits' => $this->brand->mediaKits->sortByDesc('created_at')->paginate(5),
			'tags' => CompanyController::loadTags($this->brand),
		]);
    }
}
