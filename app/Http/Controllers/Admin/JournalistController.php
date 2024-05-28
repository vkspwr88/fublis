<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\UserController;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class JournalistController extends Controller
{
    public static function create(array $data, string $model)
	{
		// dd($data);
		$data = LocationController::setLocationForCreate($data);
		$user = User::find($data['user_id']);
		$data['slug'] = UserController::generateSlug($user->name);
		$data['linked_profile'] = $data['linked_profile'] ? 'https://' . trimWebsiteUrl($data['linked_profile']) : null;
		$data['published_article_link'] = $data['published_article_link'] ? 'https://' . trimWebsiteUrl($data['published_article_link']) : null;
		$data['publishing_platform_link'] = $data['publishing_platform_link'] ? 'https://' . trimWebsiteUrl($data['publishing_platform_link']) : null;

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data, $model);
		$data['background_color'] = AvatarController::getBackground('journalist');
		$data['foreground_color'] = '#ffffff';
		$result = $model::create($data);
		JournalistController::manageMedia($mediaId, $result);
		return $result;
	}

	public static function mutateFormDataBeforeFill($data)
	{
		$data = LocationController::setLocationForEdit($data);
		// dd($data);
		return $data;
	}

	public static function update(Model $record, array $data)
	{
		$data = LocationController::setLocationForCreate($data);
		$data['linked_profile'] = $data['linked_profile'] ? 'https://' . trimWebsiteUrl($data['linked_profile']) : null;
		$data['published_article_link'] = $data['published_article_link'] ? 'https://' . trimWebsiteUrl($data['published_article_link']) : null;
		$data['publishing_platform_link'] = $data['publishing_platform_link'] ? 'https://' . trimWebsiteUrl($data['publishing_platform_link']) : null;

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data);
		$record->update($data);
		JournalistController::manageMedia($mediaId, $record);
		return $record;
	}

	public static function manageMedia($mediaId, $record)
	{
		if(!$mediaId){
			return;
		}
		$media = MediaController::getRecordById($mediaId);
		if($media){
			$newPath = 'images/journalists/profile/' . uniqid() . '.' . $media->ext;
			Storage::copy($media->path, $newPath);
			ImageController::updateOrCreate($record->profileImage(), [
				'image_type' => 'profile',
				'image_path' => $newPath,
			]);
		}
	}
}
