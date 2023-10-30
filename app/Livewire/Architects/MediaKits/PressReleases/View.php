<?php

namespace App\Livewire\Architects\MediaKits\PressReleases;

use Livewire\Component;

class View extends Component
{
	public $pressRelease;

	public function mount($pressRelease)
	{
		$this->pressRelease = $pressRelease;
	}

    public function render()
    {
        return view('livewire.architects.media-kits.press-releases.view');
    }
}
