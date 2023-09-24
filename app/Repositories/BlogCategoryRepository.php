<?php

namespace App\Repositories;

use App\Interfaces\BlogCategoryRepositoryInterface;
use App\Models\BlogCategory;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
	public function getAllBlogCategories(){
		return BlogCategory::orderBy('name', 'asc')
							->get();
	}
}
