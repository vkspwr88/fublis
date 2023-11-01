<?php

namespace App\Livewire\Journalists\MediaKits;

use App\Services\MediaKitService;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Stories extends Component
{
	private MediaKitService $mediaKitService;

	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];
	public $selectLocation = "";

	public function boot()
	{
		$this->mediaKitService = app()->make(MediaKitService::class);
	}

    public function render()
    {
        return view('livewire.journalists.media-kits.stories', [
			'mediaKits' => $this->mediaKitService->filterAllMediaKits([
				'location' => $this->selectLocation,
				'mediaKits' => $this->selectedMediaKitTypes,
				'categories' => $this->selectedCategories,
			]),
		]);
    }
}
