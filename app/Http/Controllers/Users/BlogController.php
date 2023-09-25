<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Interfaces\BlogCategoryRepositoryInterface;
use App\Interfaces\BlogIndustryRepositoryInterface;
use App\Services\BlogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
	private BlogService $blogService;
	private BlogCategoryRepositoryInterface $blogCategoryRepository;
	private BlogIndustryRepositoryInterface $blogIndustryRepository;

    public function __construct(
		BlogService $blogService,
		BlogCategoryRepositoryInterface $blogCategoryRepository,
		BlogIndustryRepositoryInterface $blogIndustryRepository,
	)
	{
		$this->blogService = $blogService;
		$this->blogCategoryRepository = $blogCategoryRepository;
		$this->blogIndustryRepository = $blogIndustryRepository;
	}

	public function index(){
		return view('users.pages.blogs.index', [
			'blogs' => $this->blogService->showAllBlogs(),
			'categories' => $this->blogCategoryRepository->getAllBlogCategories(),
			'industries' => $this->blogIndustryRepository->getAllBlogIndustries(),
		]);
	}

	public function show(string $slug) {
		$blog = $this->blogService->showBlogUsingSlug($slug);
		//dd($blog->load('tags'));
		if($blog){
			return view('users.pages.blogs.show', [
				'blog' => $blog->load('tags'),
				'latestBlogs' => $this->blogService->showLimitedBlogs(3)
			]);
		}
		abort(404);
	}
}
