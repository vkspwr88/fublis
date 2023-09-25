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
