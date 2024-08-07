<?php

namespace App\Livewire\Journalists\Submissions;

use App\Services\CallService;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Index extends Component
{
	use WithPagination, WithoutUrlPagination;

	private CallService $callService;

	public $selectedCall = '';
	public string $name = '';
	public $calls;

	public function mount()
	{
		$this->searchCall();
	}

	public function boot()
	{
		$this->callService = app()->make(CallService::class);
	}

    public function render()
    {
		$submission = $this->callService->filterSubmission([
			//'name' => $this->name,
			'call' => $this->selectedCall,
		]);
		// dd($submission);
        return view('livewire.journalists.submissions.index', [
			'mediaKits' => ( ($submission && $submission->count()) ? $submission->mediaKits : collect([]))->paginate(10),
		]);
    }

	public function getMediaKits()
	{
		$this->render();
	}

	//#[Renderless]
	public function searchCall()
	{
		$this->calls = $this->callService->searchCalls([
			'name' => $this->name,
		]);
		if($this->calls->count() > 0){
			$this->selectedCall = $this->calls[0]->id;
		}
	}
}
