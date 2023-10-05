<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class BlogController extends Controller
{
	private BlogService $blogService;

    public function __construct(
		BlogService $blogService,
	)
	{
		$this->blogService = $blogService;
	}

	public function index(){
		return view('users.pages.blogs.index');
	}

	public function show(string $slug) {
		$blog = $this->blogService->showBlogUsingSlug($slug);
		$blog->load('tags', 'blogSeo', 'bannerImage', 'seoImage');
		$blog->blogSeo->image = $blog->seoImage->path;
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
