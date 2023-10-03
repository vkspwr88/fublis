<?php

namespace App\Services;

use App\Interfaces\BlogRepositoryInterface;

class BlogService
{
	private BlogRepositoryInterface $blogRepository;

	public function __construct(
		BlogRepositoryInterface $blogRepository,
	)
	{
		$this->blogRepository = $blogRepository;
	}

	public function searchBlogsByCategoryAndIndustry(array $searchedCategories, array $searchedIndustries)
	{
		if(empty($searchedCategories) && empty($searchedIndustries)){
			return $this->blogRepository->getAllBlogs()
										->load('tags', 'homeImage');
		}
		$filterredBlogsWithCategories = $this->blogRepository->getBlogsByCategoriesId($searchedCategories);
		$filterredBlogsWithIndustries = $this->blogRepository->getBlogsByIndustriesId($searchedIndustries);
		//dd($filterredBlogsWithCategories->merge($filterredBlogsWithIndustries)->all());
		//var_dump($filterredBlogsWithCategories, $filterredBlogsWithIndustries);
		return $filterredBlogsWithCategories->intersect($filterredBlogsWithIndustries)
											->load('tags', 'homeImage');
											//->all();
	}

	public function searchBlogsByName(string $name)
	{
		//
	}

	public function showAllBlogs()
	{
		return $this->blogRepository
				->getAllBlogs()
				->load('tags');
	}

	public function showLimitedBlogs($limit){
		return $this->blogRepository
				->getLimitedBlogs($limit)
				->load('tags');
	}

	public function showBlogUsingSlug(string $slug){
		return $this->blogRepository->getBlogBySlug($slug);
	}
}
