<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\MediaKitController;
use Livewire\Component;

class Analytic extends Component
{
	public $mediaKits;
	public $searchText;

	public function mount()
	{
		$this->searchText = '';
		$this->mediaKits = MediaKitController::getUserMediaKitsAnalytics(auth()->id());
	}

    public function render()
    {
        return view('livewire.architects.account.analytic');
    }
}
