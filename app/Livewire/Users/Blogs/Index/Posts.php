<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Models\Blog;
use App\Services\BlogService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
class Posts extends Component
{
	use WithPagination;

	private BlogService $blogService;

	public $searchedCategories = [];
	public $searchedIndustries = [];
	//private $blogs;

	public function boot()
	{
		$this->blogService = app()->make(BlogService::class);
	}

	#[Computed]
	#[On('blogs-filterred')]
	public function getFilterredBlogs($searchedCategories = [], $searchedIndustries = [])
	{
		$this->searchedCategories = $searchedCategories;
		$this->searchedIndustries = $searchedIndustries;
		//dd('working');
		/* $this->blogs = $this->blogService
							->searchBlogsByCategoryAndIndustry($searchedCategories, $searchedIndustries)
							->paginate(3); */
		//return $this->blogService->searchBlogsByCategoryAndIndustry($searchedCategories, $searchedIndustries);
	}

	/* public function mount()
	{
		//sleep(600);
		$this->getFilterredBlogs();
	} */

	#[On('refresh-blogs')]
	public function refresh()
	{
		$this->resetPage();
	}

    //#[On('blogs-filterred')]
	public function render()
    {
		return view('livewire.users.blogs.index.posts', [
			/* 'blogs' => $this->blogService
							->searchBlogsByCategoryAndIndustry($searchedCategories, $searchedIndustries)
							->paginate(3), */
			//'blogs' => $this->blogs,
			'blogs' => $this->blogService
							->searchBlogsByCategoryAndIndustry($this->searchedCategories, $this->searchedIndustries)
							->paginate(2),
			//'blogs' => Blog::with('tags', 'homeImage')->orderBy('published_date', 'desc')->paginate(3)
		]);
    }
}
