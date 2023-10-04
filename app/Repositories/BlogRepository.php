<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;

class BlogRepository implements BlogRepositoryInterface
{
	public function getAllBlogs()
	{
		return Blog::orderBy('published_date', 'desc')
					->get();
	}

	public function getLimitedBlogs(int $limit)
	{
		return Blog::orderBy('published_date', 'desc')
					->limit($limit)
					->get();
	}

	public function getBlogBySlug(string $slug)
	{
		return Blog::where([
						'slug' => $slug,
						'deleted_at' => null,
					])
					->first();
	}

	public function getBlogsByCategoriesId(array $categoriesId)
	{
		if(empty($categoriesId)){
			return $this->getAllBlogs();
		}
		return Blog::whereHas('categories', function (Builder $query) use($categoriesId) {
			$query->whereIn('blog_categories.id', $categoriesId);
		})->orderBy('published_date', 'desc')
		->get();
	}

	public function getBlogsByIndustriesId(array $industriesId)
	{
		if(empty($industriesId)){
			return $this->getAllBlogs();
		}
		return Blog::whereHas('industries', function (Builder $query) use($industriesId) {
			$query->whereIn('blog_industries.id', $industriesId);
		})->orderBy('published_date', 'desc')
		->get();
	}

	public function getBlogsByTitle(string $title)
	{
		return Blog::where('title', 'LIKE', "%{$title}%")
					->orderBy('published_date', 'desc')
					->get();
	}

	public function getBlogsByAuthor(string $author)
	{
		return Blog::where('author', 'LIKE', "%{$author}%")
					->orderBy('published_date', 'desc')
					->get();
	}

	public function getBlogsByTagsName(string $name)
	{
		return Blog::whereHas('tags', function (Builder $query) use($name) {
			$query->where('blog_tags.name', 'LIKE', "%{$name}%");
		})->orderBy('published_date', 'desc')
		->get();
	}
}
