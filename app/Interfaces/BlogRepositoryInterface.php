<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
	public function getAllBlogs();
	public function getLimitedBlogs(int $limit);
}
