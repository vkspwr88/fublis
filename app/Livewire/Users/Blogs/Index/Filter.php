<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Interfaces\BlogCategoryRepositoryInterface;
use App\Interfaces\BlogIndustryRepositoryInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Filter extends Component
{
	private BlogCategoryRepositoryInterface $blogCategoryRepository;
	private BlogIndustryRepositoryInterface $blogIndustryRepository;

	public $categories;
	public $industries;
	public $selectedCategories = [];
	public $selectedIndustries = [];

	public function boot()
	{
		$this->blogCategoryRepository = app()->make(BlogCategoryRepositoryInterface::class);
		$this->blogIndustryRepository = app()->make(BlogIndustryRepositoryInterface::class);
	}

	public function render()
    {
		$this->categories = $this->blogCategoryRepository->getAllBlogCategories();
		$this->industries = $this->blogIndustryRepository->getAllBlogIndustries();
        return view('livewire.users.blogs.index.filter');
    }

	public function search()
	{
		$this->dispatch('blogs-filterred', searchedCategories: $this->selectedCategories, searchedIndustries: $this->selectedIndustries);
		$this->dispatch('refresh-blogs');
	}
}
