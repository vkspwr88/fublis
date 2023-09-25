<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
	public function getAllBlogs(){
		return Blog::orderBy('published_date', 'desc')
					->get();
	}

	public function getLimitedBlogs(int $limit){
		return Blog::orderBy('published_date', 'desc')
					->limit($limit)
					->get();
	}

	public function getBlogBySlug(string $slug){
		return Blog::where([
						'slug' => $slug,
						'deleted_at' => null,
					])
					->first();
	}
}
