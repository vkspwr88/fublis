<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public static function getAll()
	{
		return Company::all();
	}

	public static function search($field, $string){
		return Company::with('location')
							->where($field, 'like', '%' . $string . '%')
							->orderBy('name', 'desc')
							->get();
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
		//return Company::firstOrCreate($details);
		$details = Arr::add(
							$details,
							'slug',
							CompanyController::generateSlug($details['name'])
						);
		return Company::firstOrCreate(
			['name' => $details['name']],
			$details
		);
	}

	public static function generateSlug($name)
	{
		$count = Company::withTrashed()->where('name', $name)->count();
		if($count > 0){
			$name .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($name)
						);
	}

	public static function getMediaContacts()
	{
		/* $user = auth()->user()->load('architect.company.architects.user');
		return $user->architect->company->architects; */
		return auth()->user()->architect->company->architects;
		//dd(auth()->user()->load('architect.company.architects')->pluck(['id', 'name']));
	}

	public static function loadModel($brand)
	{
		return $brand->load([
			'profileImage',
			'category',
			'categories',
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

	public static function getTotalArchitects($companyId)
	{
		return Company::withCount('architects')
				->where('id', $companyId)
				->first();
	}

	public static function getAllowedArchitects($subscriptionPlan)
	{
		if(Str::contains($subscriptionPlan, 'Business Plan')){
			return 5;
		}
		if(Str::contains($subscriptionPlan, 'Enterprise Plan')){
			return 20;
		}
		return 2;
	}
}
