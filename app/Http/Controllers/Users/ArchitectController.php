<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use Illuminate\Http\Request;

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

	public static function findById(string $id)
	{
		return Architect::find($id);
	}

	public static function getAll()
	{
		return Architect::all()->load('user');
	}
}
