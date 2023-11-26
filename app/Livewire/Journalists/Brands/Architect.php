<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\ArchitectController;
use Livewire\Component;
use Livewire\WithPagination;

class Architect extends Component
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
        return view('livewire.journalists.brands.architect', [
			'mediaKits' => $this->architect->mediaKits->sortByDesc('created_at')->paginate(1),
		]);
    }
}
