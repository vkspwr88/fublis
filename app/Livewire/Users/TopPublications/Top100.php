<?php

namespace App\Livewire\Users\TopPublications;

use App\Http\Controllers\Users\PublicationController;
use App\Models\TopPublication;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Top100 extends Component
{
	use WithPagination;

	public ?TopPublication $topPublication;
	// public $publications;
	public $topPublicationList;

	public function mount($topPublication)
	{
		$this->topPublication = $topPublication;
		$this->topPublicationList = collect([]);
		if($topPublication){
			$this->topPublicationList = PublicationController::loadModel($topPublication->orderedPublications);
		}
		// $this->topPublicationList = PublicationController::loadModel($this->topPublicationList);
		// dd($this->topPublication, $this->topPublicationList);
	}

    public function render()
    {
        return view('livewire.users.top-publications.top100', [
			'publications' => $this->topPublicationList->paginate(5),
		]);
    }
}
