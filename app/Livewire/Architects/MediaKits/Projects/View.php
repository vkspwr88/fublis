<?php

namespace App\Livewire\Architects\MediaKits\Projects;

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
        return view('livewire.architects.media-kits.projects.view');
    }
}
