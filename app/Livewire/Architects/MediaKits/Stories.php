<?php

namespace App\Livewire\Architects\MediaKits;

use App\Services\MediaKitService;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Stories extends Component
{
	private MediaKitService $mediaKitService;

	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];

	public function boot()
	{
		$this->mediaKitService = app()->make(MediaKitService::class);
	}

    public function render()
    {
		//dd($this->mediaKitService->filterMediaKits($this->selectedMediaKitTypes, $this->selectedCategories));
        return view('livewire.architects.media-kits.stories', [
			'mediaKits' => $this->mediaKitService->filterMediaKits($this->selectedMediaKitTypes, $this->selectedCategories),
		]);
    }
}
