<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
//use App\Interfaces\BlogCategoryRepositoryInterface;
//use App\Interfaces\BlogIndustryRepositoryInterface;
use App\Services\BlogService;
//use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class BlogController extends Controller
{
	private BlogService $blogService;
	//private BlogCategoryRepositoryInterface $blogCategoryRepository;
	//private BlogIndustryRepositoryInterface $blogIndustryRepository;

    public function __construct(
		BlogService $blogService,
		//BlogCategoryRepositoryInterface $blogCategoryRepository,
		//BlogIndustryRepositoryInterface $blogIndustryRepository,
	)
	{
		$this->blogService = $blogService;
		//$this->blogCategoryRepository = $blogCategoryRepository;
		//$this->blogIndustryRepository = $blogIndustryRepository;
	}

	public function index(){
		/* return view('users.pages.blogs.index', [
			'blogs' => $this->blogService->showAllBlogs()->load('homeImage'),
			'categories' => $this->blogCategoryRepository->getAllBlogCategories(),
			'industries' => $this->blogIndustryRepository->getAllBlogIndustries(),
		]); */
		return view('users.pages.blogs.index');
	}

	public function show(string $slug) {
		$blog = $this->blogService->showBlogUsingSlug($slug);
		//dd($blog->load('tags'));
		$blog->load('tags', 'blogSeo', 'bannerImage', 'seoImage');
		$blog->blogSeo->image = $blog->seoImage->path;
		//dd($blog->blogSeo);
		$seoData = new SEOData(
			title: $blog->blogSeo->title,
			description: $blog->blogSeo->description,
			author: $blog->blogSeo->author,
			image: 'storage/' . $blog->seoImage->path,
		);
		if($blog){
			return view('users.pages.blogs.show', [
				'blog' => $blog,
				'seoData' => $seoData,
				'latestBlogs' => $this->blogService->showLimitedBlogs(3)->load('homeImage')
			]);
		}
		abort(404);
	}
}
