<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\MediaKitController;
use Livewire\Component;

class Analytic extends Component
{
	public $mediaKits;
	public $filterredMediaKits;
	public $searchText;

	public function mount()
	{
		$this->searchText = '';
	}

    public function render()
    {
		// $this->filterredMediaKits = $this->mediaKits->where('story.title', '%' . $this->searchText . '%');
		$this->mediaKits = MediaKitController::getUserMediaKitsAnalytics(auth()->id(), $this->searchText);
        return view('livewire.architects.account.analytic');
    }
}
