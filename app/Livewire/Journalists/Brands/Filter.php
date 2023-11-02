<?php

namespace App\Livewire\Journalists\Brands;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use Livewire\Component;

class Filter extends Component
{
	public $selectLocation;
	public $selectedCategories = [];

    public function render()
    {
        return view('livewire.journalists.brands.filter', [
			'locations' => LocationController::getAll(),
			'categories' => CategoryController::getAll(),
		]);
    }
}
