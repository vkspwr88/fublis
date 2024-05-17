<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\ArchitectController as UsersArchitectController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\UserController;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ArchitectController extends Controller
{
    public static function create(array $data, string $model)
	{
		$data = LocationController::setLocationForCreate($data);
		$user = User::find($data['user_id']);
		$data['slug'] = UserController::generateSlug($user->name);
		/* $data['twitter'] = $data['twitter'] ? 'https://' . trimWebsiteUrl($data['twitter']) : null;
		$data['facebook'] = $data['facebook'] ? 'https://' . trimWebsiteUrl($data['facebook']) : null;
		$data['instagram'] = $data['instagram'] ? 'https://' . trimWebsiteUrl($data['instagram']) : null;
		$data['linkedin'] = $data['linkedin'] ? 'https://' . trimWebsiteUrl($data['linkedin']) : null; */


		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data, $model);
		$data['background_color'] = AvatarController::getBackground('architect');
		$data['foreground_color'] = '#ffffff';
		$result = $model::create($data);
		ArchitectController::manageMedia($mediaId, $result);
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
		$data['twitter'] = $data['twitter'] ? 'https://' . trimWebsiteUrl($data['twitter']) : null;
		$data['facebook'] = $data['facebook'] ? 'https://' . trimWebsiteUrl($data['facebook']) : null;
		$data['instagram'] = $data['instagram'] ? 'https://' . trimWebsiteUrl($data['instagram']) : null;
		$data['linkedin'] = $data['linkedin'] ? 'https://' . trimWebsiteUrl($data['linkedin']) : null;

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data);
		$record->update($data);
		ArchitectController::manageMedia($mediaId, $record);
		return $record;
	}

	public static function manageMedia($mediaId, $record)
	{
		if(!$mediaId){
			return;
		}
		$media = MediaController::getRecordById($mediaId);
		if($media){
			$newPath = 'images/architects/profile/' . uniqid() . '.' . $media->ext;
			Storage::copy($media->path, $newPath);
			ImageController::updateOrCreate($record->profileImage(), [
				'image_type' => 'profile',
				'image_path' => $newPath,
			]);
		}
	}
}
