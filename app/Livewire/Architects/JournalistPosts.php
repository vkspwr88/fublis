<?php

namespace App\Livewire\Architects;

use App\Services\JournalistPostService;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class JournalistPosts extends Component
{
	use WithPagination;

	private JournalistPostService $postService;

	public $journalist;

	public function mount($journalist)
	{
		//dd($journalist);
		$this->journalist = $journalist;
	}

	public function boot()
	{
		$this->postService = app()->make(JournalistPostService::class);
	}

    public function render()
    {
        return view('livewire.architects.journalist-posts', [
			'posts' => $this->postService->getJournalistPosts($this->journalist)->paginate(10),
		]);
    }
}
