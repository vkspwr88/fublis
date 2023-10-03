<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Services\BlogService;
use Livewire\Component;

class Posts extends Component
{
	private BlogService $blogService;

	public $blogs = [];

	public function boot()
	{
		$this->blogService = app()->make(BlogService::class);
	}

	public function getFilterredBlogs($showAll = true)
	{
		if($showAll){
			$this->blogs = $this->blogService->showAllBlogs()->load('homeImage');
			return;
		}
	}

	public function mount()
	{
		$this->getFilterredBlogs();
	}

    public function render()
    {

        return view('livewire.users.blogs.index.posts');
    }
}
