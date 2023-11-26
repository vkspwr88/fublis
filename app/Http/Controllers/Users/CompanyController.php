<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public static function getAll()
	{
		return Company::all();
	}

	public static function getArchitectCompany($userId)
	{
		$brand = Company::whereHas('architects', function (Builder $query) use($userId) {
			$query->where('user_id', $userId);
		})->first();
		if(!$brand){
			return abort(404);
		}
		return $brand;
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

	public static function loadModel($brand)
	{
		return $brand->load([
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
