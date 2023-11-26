<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\CompanyController;
use App\Models\Architect;
use App\Models\Company;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
	{
		return view('users.pages.journalists.brands.index');
	}

	public function view(Company $brand)
	{
		if(!$brand){
			return abort(404);
		}

		/* $brand->load([
			'profileImage',
			'category',
			'location',
			'teamSize',
			'architects' => [
				'profileImage',
				'position',
				'user',
			],
			'mediaKits' => [
				'story.tags',
				'architect.company.profileImage',
				'category',
			],
		]); */
		//$brand = CompanyController::loadModel($brand);

		//dd($brand->mediaKits->pluck('story')->pluck('tags')->flatten()->pluck('name')->unique());
		return view('users.pages.journalists.brands.view', [
			'brand' => $brand,
			/* 'mediaKits' => $brand->mediaKits->sortByDesc('created_at')->paginate(5),
			'tags' => CompanyController::loadTags($brand), */
		]);
	}

	public function architect(Architect $architect)
	{
		if(!$architect){
			return abort(404);
		}
		$architect = ArchitectController::loadModel($architect);
		return view('users.pages.journalists.brands.architect', [
			'architect' => $architect
		]);
	}
}
