<?php

namespace App\Services;

use App\Interfaces\BlogRepositoryInterface;

class BlogService
{
	protected BlogRepositoryInterface $blogRepository;

	public function __construct(
		BlogRepositoryInterface $blogRepository,
	)
	{
		$this->blogRepository = $blogRepository;
	}
}
