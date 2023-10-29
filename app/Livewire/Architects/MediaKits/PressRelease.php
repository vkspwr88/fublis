<?php

namespace App\Livewire\Architects\MediaKits;

use Livewire\Component;

class PressRelease extends Component
{
	public $pressRelease;

	public function mount($pressRelease)
	{
		$this->pressRelease = $pressRelease;
	}

    public function render()
    {
        return view('livewire.architects.media-kits.press-release');
    }
}
