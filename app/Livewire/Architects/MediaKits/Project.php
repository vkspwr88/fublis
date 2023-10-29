<?php

namespace App\Livewire\Architects\MediaKits;

use Livewire\Component;

class Project extends Component
{
	public $project;

	public function mount($project)
	{
		$this->project = $project;
	}

    public function render()
    {
        return view('livewire.architects.media-kits.project');
    }
}
