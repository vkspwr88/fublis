<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
	public function getAllBlogs();
	public function getLimitedBlogs(int $limit);
	public function getBlogBySlug(string $slug);
	public function getBlogsByCategoriesId(array $categoriesId);
	public function getBlogsByIndustriesId(array $industriesId);
}
