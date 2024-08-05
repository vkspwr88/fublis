<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\MediaKit;
use App\Models\PressRelease;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public static function getAll()
	{
		return [
			[
				'id' => 'App\Models\PressRelease',
				'name' => 'Press Releases',
			],
			[
				'id' => 'App\Models\Project',
				'name' => 'Projects',
			],
			[
				'id' => 'App\Models\Article',
				'name' => 'Articles',
			],
		];
	}

	public static function getMediaKitById(string $id)
	{
		return MediaKit::find($id);
	}

	public static function getUserMediaKitsAnalytics(string $userId)
	{
		return MediaKit::whereHas('architect', function (Builder $query) use ($userId) {
							$query->where('user_id', $userId);
						})->with(['story', 'analytics'])
						->withCount([
							'analytics as view_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitView');
							},
							'analytics as download_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitDownload');
							},
						])
						->get();
	}

	public static function loadModel($mediaKit, $type)
	{
		if($type === 'press-release'){
			return $mediaKit->load([
				'downloadRequests',
				'story' => [
					'photographs',
					'tags',
				],
				'category',
				'architect' => [
					'company' => [
						'profileImage'
					],
					'profileImage',
					'user',
					'position'
				],
				'mediaContact' => [
					'user',
					'profileImage',
					'position',
				],
				'projectAccess',
			]);
		}
		if($type === 'project'){
			return $mediaKit->load([
				'downloadRequests',
				'story' => [
					'photographs',
					'location',
					'siteAreaUnit',
					'builtUpAreaUnit',
					'projectStatus',
					'buildingUse' => [
						'buildingTypology'
					],
				],
				'category',
				'architect' => [
					'company' => [
						'profileImage'
					],
					'profileImage',
					'user',
					'position'
				],
				'mediaContact' => [
					'user',
					'profileImage',
					'position',
				],
				'projectAccess',
			]);
		}
		if($type === 'article'){
			return $mediaKit->load([
				'downloadRequests',
				'story.images',
				'category',
				'architect' => [
					'company' => [
						'profileImage'
					],
					'profileImage',
					'user',
					'position'
				],
				'mediaContact' => [
					'user',
					'profileImage',
					'position',
				],
				'projectAccess',
			]);
		}
	}

	public static function isAllowedToAdd($type)
	{
		if(isBusinessPlanSubscribed()){
			return true;
		}
		$allowedMediaKits = self::getAllowedMediaKits($type);
		$createdMediaKits = 0;
		$architectID = auth()->user()->architect->id;
		if($type == 'press-release'){
			$createdMediaKits = MediaKit::whereHasMorph('story', PressRelease::class)->where('architect_id', $architectID)->count();
		}
		elseif($type == 'article'){
			$createdMediaKits = MediaKit::whereHasMorph('story', Article::class)->where('architect_id', $architectID)->count();
		}
		elseif($type == 'project'){
			$createdMediaKits = MediaKit::whereHasMorph('story', Project::class)->where('architect_id', $architectID)->count();
		}

		if( $createdMediaKits < $allowedMediaKits ){
			return true;
		}
		return false;
	}

	public static function getAllowedMediaKits($type)
	{
		if(isEnterprisePlanSubscribed()){
			return 25;
		}
		return 3; // free user
	}
}
