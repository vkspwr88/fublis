<?php

namespace App\Livewire\Journalists\Submissions;

use Livewire\Component;

class Filter extends Component
{
    public function render()
    {
		//dd(auth()->user()->journalist->calls);
        return view('livewire.journalists.submissions.filter', [
			'calls' => auth()->user()->journalist->calls,
		]);
    }
}
