<?php

namespace App\Http\Controllers\Users;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\MediaKit;
use App\Models\PressRelease;
use App\Models\Project;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
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

	public static function getUserMediaKitsAnalytics(string $userId, string $name = '')
	{
		return MediaKit::whereHas('architect', function (Builder $query) use ($userId) {
							$query->where('user_id', $userId);
						})
						->with(['story'])
						->withCount([
							'pitch as total_pitches_count',
							'downloadRequests as total_request_count',
							'downloadRequests as total_pending_count' => function (Builder $query) {
								$query->where('request_status', RequestStatusEnum::PENDING);
							},
							'downloadRequests as total_approved_count' => function (Builder $query) {
								$query->where('request_status', RequestStatusEnum::APPROVED);
							},
							'downloadRequests as total_declined_count' => function (Builder $query) {
								$query->where('request_status', RequestStatusEnum::DECLINED);
							},
							'analytics as view_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitView');
							},
							'analytics as download_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitDownload');
							},
						])
						->whereHasMorph(
							'story',
							[PressRelease::class, Project::class, Article::class],
							function(Builder $query) use($name) {
								$query->where('title', 'LIKE', '%' . $name . '%');
							}
						)
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
		$createdMediaKits = self::getTotalCreatedMediaKits($type);
		// $architectID = auth()->user()->architect->id;
		// if($type == 'press-release'){
		// 	$createdMediaKits = MediaKit::whereHasMorph('story', PressRelease::class)->where('architect_id', $architectID)->count();
		// }
		// elseif($type == 'article'){
		// 	$createdMediaKits = MediaKit::whereHasMorph('story', Article::class)->where('architect_id', $architectID)->count();
		// }
		// elseif($type == 'project'){
		// 	$createdMediaKits = MediaKit::whereHasMorph('story', Project::class)->where('architect_id', $architectID)->count();
		// }

		if( $createdMediaKits < $allowedMediaKits ){
			return true;
		}
		return false;
	}

	public static function getTotalCreatedMediaKits($type)
	{
		$architectID = auth()->user()->architect->id;
		if($type == 'press-release'){
			return MediaKit::whereHasMorph('story', PressRelease::class)->where('architect_id', $architectID)->count();
		}
		elseif($type == 'article'){
			return MediaKit::whereHasMorph('story', Article::class)->where('architect_id', $architectID)->count();
		}
		elseif($type == 'project'){
			return MediaKit::whereHasMorph('story', Project::class)->where('architect_id', $architectID)->count();
		}
		return 0;
	}

	public static function getAllowedMediaKits($type)
	{
		if(isEnterprisePlanSubscribed()){
			return 25;
		}
		return 3; // free user
	}
}
