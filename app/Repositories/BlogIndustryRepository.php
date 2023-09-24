<?php

namespace App\Repositories;

use App\Interfaces\BlogIndustryRepositoryInterface;
use App\Models\BlogIndustry;

class BlogIndustryRepository implements BlogIndustryRepositoryInterface
{
	public function getAllBlogIndustries(){
		return BlogIndustry::orderBy('name', 'asc')
							->get();
	}
}
