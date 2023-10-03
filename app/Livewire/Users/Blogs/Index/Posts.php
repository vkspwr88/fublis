<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Services\BlogService;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
	private BlogService $blogService;

	public $blogs = [];

	public function boot()
	{
		$this->blogService = app()->make(BlogService::class);
	}

	#[On('blogs-filterred')]
	public function getFilterredBlogs($searchedCategories = [], $searchedIndustries = [])
	{
		//dd('working');
		$this->blogs = $this->blogService->searchBlogsByCategoryAndIndustry($searchedCategories, $searchedIndustries);
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
