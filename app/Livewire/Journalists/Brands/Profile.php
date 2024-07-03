<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\CompanyController;
use App\Livewire\Forms\FilterMediaKitsForm;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Profile extends Component
{
	use WithPagination, WithoutUrlPagination;

	public FilterMediaKitsForm $form;

	public $brand;
	public $mediaKits;
	public $tags;

	public function mount($brand)
	{
		$this->brand = CompanyController::loadModel($brand);
		$this->mediaKits = $brand->mediaKits->sortByDesc('created_at');
		$this->tags = CompanyController::loadTags($brand);
		$this->form->mount();
	}

    public function render()
    {
        return view('livewire.journalists.brands.profile', [
			'filterredMediaKits' => $this->form->filterMediaKit($this->mediaKits),
		]);
    }

	public function removeFilterOption($key)
	{
		$this->form->selectedMediaKitTypes->pull($key);
	}
}
