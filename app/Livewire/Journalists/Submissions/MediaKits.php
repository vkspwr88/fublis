<?php

namespace App\Livewire\Journalists\Submissions;

use App\Services\CallService;
use Livewire\Component;

class MediaKits extends Component
{
    public $selectCall = "";

	private CallService $callService;

	public function boot()
	{
		$this->callService = app()->make(CallService::class);
	}

    public function render()
    {
        return view('livewire.journalists.submissions.media-kits', [
			'mediaKits' => $this->callService->filterSubmission($this->selectCall),
		]);
    }
}
