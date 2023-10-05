<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
	public function getAllBlogs();
	public function getAllBlogsWithoutPaginate();
	public function getLimitedBlogs(int $limit);
	public function getBlogBySlug(string $slug);
	public function getBlogsByCategoriesId(array $categoriesId);
	public function getBlogsByIndustriesId(array $industriesId);
	public function getBlogsByCategoriesIdAndIndustriesId(array $categoriesId, array $industriesId);
	public function getBlogsByTitle(string $title);
	public function getBlogsByAuthor(string $author);
	public function getBlogsByTagsName(string $name);
}
