<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\ArchitectController;
use App\Livewire\Forms\FilterMediaKitsForm;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
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
        return view('livewire.architects.account.profile', [
			'filterredMediaKits' => $this->form->filterMediaKit($this->mediaKits),
		]);
    }

	public function removeFilterOption($key)
	{
		$this->form->selectedMediaKitTypes->pull($key);
	}
}
