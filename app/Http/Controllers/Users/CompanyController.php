<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public static function getAll()
	{
		return Company::all();
	}

	public static function createCompany($details)
	{
		return Company::firstOrCreate($details);
	}

	public static function getMediaContacts()
	{
		$user = auth()->user()->load('architect.company.architects.user');
		return $user->architect->company->architects;
		//dd(auth()->user()->load('architect.company.architects')->pluck(['id', 'name']));
	}

	public static function loadModel($model)
	{
		return $model->load([
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
		]);
	}

	public static function loadTags($brand)
	{
		return $brand->mediaKits
						->pluck('story')
						->pluck('tags')
						->flatten()
						->pluck('name')
						->unique();
	}
}
