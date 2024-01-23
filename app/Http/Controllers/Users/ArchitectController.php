<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArchitectController extends Controller
{
	public static function getArchitect(string $userId)
	{
		$architect = Architect::where('user_id', $userId)
								->first();
		//dd($brand);
		if(!$architect){
			return abort(404);
		}
		return $architect;
	}

	public static function createArchitect($details)
	{
		return Architect::create($details);
	}

	public static function generateSlug($name)
	{
		$count = User::where('name', $name)->count();
		if($count > 1){
			$name .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($name)
						);
	}

    public static function getArchitectDetailsByUserId(string $userId)
	{
		return Architect::with([
							'user',
							'profileImage',
							'position',
							'location.state.country',
							'company',
						])->where('user_id', $userId)
						->first();
	}

	public static function loadModel($model)
	{
		return $model->load([
							'profileImage',
							'position',
							'location',
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
	}
}
