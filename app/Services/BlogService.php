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
		// when both are not checked
		if(empty($searchedCategories) && empty($searchedIndustries)){
			return $this->blogRepository
						->getAllBlogsWithoutPaginate();
		}

		// when only category is checked
		if(empty($searchedIndustries))
		{
			return $this->blogRepository
						->getBlogsByCategoriesId($searchedCategories);
		}

		// when only industry is checked
		if(empty($searchedCategories))
		{
			return $this->blogRepository
						->getBlogsByIndustriesId($searchedIndustries);
		}
		
		// when both are checked
		return $this->blogRepository
					->getBlogsByCategoriesIdAndIndustriesId($searchedCategories, $searchedIndustries);
	}

	public function searchBlogsByName(string $name)
	{
		return array(
			'name' => $this->blogRepository->getBlogsByTitle($name),
			'author' => $this->blogRepository->getBlogsByAuthor($name),
			'tags' => $this->blogRepository->getBlogsByTagsName($name),
		);
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
