<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use App\Http\Controllers\Users\MediaKitController;
use Livewire\Form;
use Illuminate\Support\Str;

class FilterMediaKitsForm extends Form
{
    public $mediaKitTypes;
	public $searchedName;
	public $selectedMediaKitTypes;

	public function mount()
	{
		$this->searchedName = '';
		$this->mediaKitTypes = MediaKitController::getAll();
		$this->selectedMediaKitTypes = collect([]);
	}

	public function filterMediaKit($mediaKits)
	{
		if($this->searchedName != ''){
			$mediaKits = $mediaKits->filter( function ($value, $key) {
				return Str::contains(strtolower($value->story->title), strtolower($this->searchedName));
			});
		}
		if($this->selectedMediaKitTypes->count()){
			$mediaKits = $mediaKits->whereIn('story_type', $this->selectedMediaKitTypes);
		}
		return $mediaKits->paginate(5);
	}
}
