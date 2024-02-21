<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\MediaKitController;
use App\Livewire\Forms\FilterMediaKitsForm;
use Livewire\Component;
use Livewire\WithPagination;

class Studio extends Component
{
	use WithPagination;

	public FilterMediaKitsForm $form;

	public $brand;
	public $mediaKits;
	public $tags;

	public function mount()
	{
		$brand = CompanyController::getArchitectCompany(auth()->id());
		$brand = CompanyController::loadModel($brand);
		$this->brand = $brand;
		$this->mediaKits = $brand->mediaKits->sortByDesc('created_at');
		$this->tags = CompanyController::loadTags($brand);
		$this->form->mount();
	}

    public function render()
    {
        return view('livewire.architects.account.studio', [
			'filterredMediaKits' => $this->form->filterMediaKit($this->mediaKits),
		]);
    }

	public function removeFilterOption($key)
	{
		$this->form->selectedMediaKitTypes->pull($key);
	}
}
