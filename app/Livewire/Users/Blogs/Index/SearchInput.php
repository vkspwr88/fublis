<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Services\BlogService;
use Livewire\Component;

class SearchInput extends Component
{
	public string $searchInput;
	public bool $showSearchBox;

	public $postsByName = [];
	public $postsByAuthor = [];
	public $postsByTags = [];

	private BlogService $blogService;

	public function mount()
	{
		$this->showSearchBox = false;
	}

	public function boot()
	{
		$this->blogService = app()->make(BlogService::class);
	}

    public function render()
    {
        return view('livewire.users.blogs.index.search-input');
    }

	public function searchPosts()
	{
		if($this->searchInput != ''){
			$searchedPosts = $this->blogService->searchBlogsByName($this->searchInput);
			$this->postsByName = $searchedPosts['name'];
			$this->postsByAuthor = $searchedPosts['author'];
			$this->postsByTags = $searchedPosts['tags'];
			//dd($this->postsByName);
		}
	}
}
