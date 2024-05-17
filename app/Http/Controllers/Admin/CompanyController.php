<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\CompanyController as UsersCompanyController;
use App\Http\Controllers\Users\ImageController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public static function create(array $data, string $model)
	{
		$data = LocationController::setLocationForCreate($data);
		$data['slug'] = UsersCompanyController::generateSlug($data['name']);
		$data['website'] = $data['website'] ? 'https://' . trimWebsiteUrl($data['website']) : null;

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		$data['background_color'] = AvatarController::getBackground('studio');
		$data['foreground_color'] = '#ffffff';
		$result = $model::create($data);
		CompanyController::manageMedia($mediaId, $result);
		return $result;
	}

	public static function update(Model $record, array $data)
	{
		$data = LocationController::setLocationForCreate($data);
		$data['website'] = $data['website'] ? 'https://' . trimWebsiteUrl($data['website']) : null;

		$mediaId = $data['media_id'];
		Arr::forget($data, ['media_id']);
		// dd($data);
		$record->update($data);
		CompanyController::manageMedia($mediaId, $record);
		return $record;
	}

	public static function mutateFormDataBeforeFill($data)
	{
		$data = LocationController::setLocationForEdit($data);
		// dd($data);
		return $data;
	}

	public static function manageMedia($mediaId, $record)
	{
		if(!$mediaId){
			return;
		}
		$media = MediaController::getRecordById($mediaId);
		if($media){
			$newPath = 'images/companies/logos/' . uniqid() . '.' . $media->ext;
			Storage::copy($media->path, $newPath);
			ImageController::updateOrCreate($record->profileImage(), [
				'image_type' => 'logo',
				'image_path' => $newPath,
			]);
		}
	}
}
