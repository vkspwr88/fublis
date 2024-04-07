<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\ArchitectController as UsersArchitectController;
use App\Http\Controllers\Users\ImageController;
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
		$data['slug'] = UsersArchitectController::generateSlug($user->name);

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data, $model);
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
			$newPath = 'images/architects/logos/' . uniqid() . '.' . $media->ext;
			Storage::copy($media->path, $newPath);
			ImageController::updateOrCreate($record->profileImage(), [
				'image_type' => 'profile',
				'image_path' => $newPath,
			]);
		}
	}
}
