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
		/* $filterredBlogsWithCategories = Blog::whereHas('categories', function (Builder $query) {
												$query->whereIn('blog_categories.id', $this->selectedCategories);
											})->get();

		$filterredBlogsWithIndustries = Blog::whereHas('industries', function (Builder $query) {
												$query->whereIn('blog_industries.id', $this->selectedIndustries);
											})->get(); */


		/* $filterredBlogsWithCategories = Blog::all()
											->filterredCategories($this->selectedCategories)
											->latest()
											->ddRawSql(); */
		/* $filterredBlogsWithCategories = Blog::with('categories')
											//->wherePivotIn('blog_category_id', $this->selectedCategories)
											//->latest()
											/* ->when($this->selectedCategories, function(Builder $query, array $selectedCategories) {
												//dd($query->get(), $selectedCategories);
												$query->whereIn('blogs.categories.id', $selectedCategories);
											}) *
											->ddRawSql(); */
		//dd($filterredBlogsWithCategories);
		/* $filterredBlogsWithIndustries = Blog::with('industries')
						->wherePivotIn('blog_industry_id', $this->selectedIndustries)
						->latest()
						->get(); */
		//dd($filterredBlogsWithCategories, $filterredBlogsWithIndustries);
	}
}
