<?php

namespace App\Livewire\Architects\MediaKits;

use App\Http\Controllers\Users\Architects\MediaKitController;
use App\Http\Controllers\Users\CategoryController;
use Livewire\Component;

class Filter extends Component
{
    public function render()
    {
        return view('livewire.architects.media-kits.filter', [
			'categories' => CategoryController::getAll(),
			'mediaKitTypes' => MediaKitController::getAll(),
		]);
    }
}
