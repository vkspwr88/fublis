<?php

namespace App\Livewire\Architects\Header;

use App\Services\PitchStoryService;
use Livewire\Component;

class Search extends Component
{
	private PitchStoryService $pitchStoryService;

	public $searchInput;
	public bool $showSearchBox;
	public $publications;
	public $journalists;
	public $mobile;

	public function mount($mobile = false)
	{
		$this->showSearchBox = false;
		$this->publications = collect([]);
		$this->journalists = collect([]);
		$this->mobile = $mobile;
	}

	public function boot()
	{
		$this->pitchStoryService = app()->make(PitchStoryService::class);
	}

    public function render()
    {
        return view('livewire.architects.header.search');
    }

	public function showSearch()
	{
		$this->showSearchBox = true;
	}

	public function search()
	{
		// dd($this->searchInput);
		if($this->searchInput != ''){
			$this->publications = $this->pitchStoryService->filterPublications([
				'name' => $this->searchInput,
				'location' => '',
				'publicationTypes' => [],
				'categories' => [],
			]);
			$this->journalists = $this->pitchStoryService->filterJournalists([
				'name' => $this->searchInput,
				'location' => '',
				'publicationTypes' => [],
				'positions' => [],
				'categories' => [],
			]);
		}
	}
}
