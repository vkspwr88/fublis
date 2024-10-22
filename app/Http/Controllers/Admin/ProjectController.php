<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\LocationController as UsersLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PDO;

class ProjectController extends Controller
{
	public static function create(array $data, string $model)
	{
		// dd($data);
		$data['state_id'] = $data['state'];
		$data['city_id'] = $data['location_id'];
		$data['location_id'] = $data['country'];
		Arr::forget($data, ['country', 'state']);
		// $data = LocationController::setLocationForCreate($data);
		// $user = User::find($data['user_id']);
		// $data['slug'] = UserController::generateSlug($user->name);
		// $data['linked_profile'] = $data['linked_profile'] ? 'https://' . trimWebsiteUrl($data['linked_profile']) : null;
		// $data['published_article_link'] = $data['published_article_link'] ? 'https://' . trimWebsiteUrl($data['published_article_link']) : null;
		// $data['publishing_platform_link'] = $data['publishing_platform_link'] ? 'https://' . trimWebsiteUrl($data['publishing_platform_link']) : null;

		// $mediaId = $data['media_id'];
		// Arr::forget($data, ['media_id']);
		// // dd($data, $model);
		// $data['background_color'] = AvatarController::getBackground('journalist');
		// $data['foreground_color'] = '#ffffff';
		$result = $model::create($data);
		// JournalistController::manageMedia($mediaId, $result);
		return $result;
	}

    public static function mutateFormDataBeforeFill($data)
	{
		if($data['location_id']){
			$location = UsersLocationController::findById($data['location_id']);
			if($location){
				$data = LocationController::setLocationForEdit($data);
			}
			else{
				$data['country'] = $data['location_id'];
				$data['state'] = $data['state_id'];
				$data['location_id'] = $data['city_id'];
				Arr::forget($data, ['city_id', 'state_id']);
			}
		}

		if($data['building_use_id']){
			$buildingUse = BuildingUseController::findById($data['building_use_id']);
			$data['building_typology_id'] = $buildingUse->buildingTypology->id;
		}
		return $data;
	}
}
