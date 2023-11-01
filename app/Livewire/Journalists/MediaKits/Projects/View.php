<?php

namespace App\Livewire\Journalists\MediaKits\Projects;

use Livewire\Component;

class View extends Component
{
	public $project;

	public function mount($project)
	{
		$this->project = $project;
	}

    public function render()
    {
        return view('livewire.journalists.media-kits.projects.view');
    }
}
