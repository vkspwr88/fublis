<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Services\BlogService;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

#[Lazy]
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
		//sleep(600);
		$this->getFilterredBlogs();
	}

	public function placeholder()
    {
        return <<<'HTML'
        <div>
            HI I AM LOADING
            <svg>...</svg>
        </div>
        HTML;
    }

    public function render()
    {

        return view('livewire.users.blogs.index.posts');
    }
}
