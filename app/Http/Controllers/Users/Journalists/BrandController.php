<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
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

		$brand->load([
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
		]);
		//dd($brand->mediaKits->pluck('story')->pluck('tags')->flatten()->pluck('name')->unique());
		return view('users.pages.journalists.brands.view', [
			'brand' => $brand,
			'tags' => $brand->mediaKits
							->pluck('story')
							->pluck('tags')
							->flatten()
							->pluck('name')
							->unique()
		]);
	}

	public function architect(Architect $architect)
	{
		if(!$architect){
			return abort(404);
		}
		$architect->load([
			'profileImage',
			'position',
			'user',
			'company' => [
				'profileImage',
				'location'
			],
			'mediaKits' => [
				'story.tags',
				'architect.company.profileImage',
				'category',
			],
		]);
		return view('users.pages.journalists.brands.architect', [
			'architect' => $architect
		]);
	}
}
