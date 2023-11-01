<?php

namespace App\Livewire\Journalists\MediaKits;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\MediaKitController;
use Livewire\Component;

class Filter extends Component
{
	public $selectLocation;
	public $selectedMediaKitTypes = [];
	public $selectedCategories = [];

    public function render()
    {
        return view('livewire.journalists.media-kits.filter', [
			'locations' => LocationController::getAll(),
			'categories' => CategoryController::getAll(),
			'mediaKitTypes' => MediaKitController::getAll(),
		]);
    }
}
