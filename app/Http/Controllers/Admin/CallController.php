<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\Journalists\CallController as JournalistsCallController;
use App\Http\Controllers\Users\LocationController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public static function create(array $data, string $model)
	{
		$data = CallController::setLocationForCreate($data);
		$data['slug'] = JournalistsCallController::generateSlug($data['title']);
		return $model::create($data);
	}

	public static function mutateFormDataBeforeFill($data)
	{
		$data = CallController::setLocationForEdit($data);
		// dd($data);
		return $data;
	}

	public static function setLocationForCreate($data)
	{
		$location = LocationController::createLocation([
			'name' => $data['location_id'],
			'city_flag' => 0,
			'state_flag' => 0,
			'country_flag' => 1,
		]);
		$data['location_id'] = $location->id;
		return $data;
	}

	public static function setLocationForEdit($data)
	{
		$location = LocationController::findById($data['location_id']);
		// $country = LocationController::getCountryByCountryName($location->name);
		$data['location_id'] = strtolower($location->name);
		return $data;
	}

	public static function update(Model $record, array $data)
	{
		$data = CallController::setLocationForEdit($data);
		$record->update($data);
		return $record;
	}
}
