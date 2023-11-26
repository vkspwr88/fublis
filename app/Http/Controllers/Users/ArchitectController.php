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

    public static function getArchitectDetailsByUserId(string $userId)
	{
		return Architect::with([
							'user',
							'profileImage',
							'position',
							'location',
							'company',
						])->where('user_id', $userId)
						->first();
	}

	public static function loadModel($model)
	{
		return $model->load([
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
	}
}
