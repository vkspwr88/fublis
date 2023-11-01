<?php

namespace App\Livewire\Journalists\MediaKits\PressReleases;

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
        return view('livewire.journalists.media-kits.press-releases.view');
    }
}
