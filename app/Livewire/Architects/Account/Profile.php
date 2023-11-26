<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\ArchitectController;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
	use WithPagination;

	public $architect;

	public function mount($architect)
	{
		$this->architect = $architect;
	}

    public function render()
    {
		$this->architect = ArchitectController::loadModel($this->architect);
        return view('livewire.architects.account.profile', [
			'mediaKits' => $this->architect->mediaKits->sortByDesc('created_at')->paginate(5),
		]);
    }
}
