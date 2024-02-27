<?php

namespace App\Livewire\Users\TopJournalists;

use App\Http\Controllers\Users\JournalistController;
use App\Models\TopJournalist;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy()]
class Top100 extends Component
{
    use WithPagination;

	public ?TopJournalist $topJournalist;
	// public $publications;
	public $topJournalistList;
	
	public function mount($topJournalist)
	{
		$this->topJournalist = $topJournalist;
		$this->topJournalistList = collect([]);
		if($topJournalist){
			// dd($topJournalist, )
			$this->topJournalistList = JournalistController::loadModel($topJournalist->orderedJournalists);
		}
	}
	
	public function render()
    {
        return view('livewire.users.top-journalists.top100', [
			'journalists' => $this->topJournalistList->paginate(5),
		]);
    }
}
