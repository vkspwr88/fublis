<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\ArchitectController;
use App\Livewire\Forms\FilterMediaKitsForm;
use Livewire\Component;
use Livewire\WithPagination;

class Architect extends Component
{
	use WithPagination;

	public FilterMediaKitsForm $form;

	public $architect;
	public $mediaKits;

	public function mount($architect)
	{
		$this->architect = ArchitectController::loadModel($architect);
		$this->mediaKits = $architect->mediaKits->sortByDesc('created_at');
		$this->form->mount();
	}

    public function render()
    {
        return view('livewire.journalists.brands.architect', [
			'filterredMediaKits' => $this->form->filterMediaKit($this->mediaKits),
		]);
    }

	public function removeFilterOption($key)
	{
		$this->form->selectedMediaKitTypes->pull($key);
	}
}
