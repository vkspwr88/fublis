<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\LocationController as UsersLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LocationController extends Controller
{
    public static function setLocationForCreate($data)
	{
		$country = UsersLocationController::getCountryById($data['country']);
		UsersLocationController::createLocation([
			'name' => $country->name,
			'city_flag' => 0,
			'state_flag' => 0,
			'country_flag' => 1,
		]);
		$state = UsersLocationController::getStateById($data['state']);
		UsersLocationController::createLocation([
			'name' => $state->name,
			'city_flag' => 0,
			'state_flag' => 1,
			'country_flag' => 0,
		]);
		$city = UsersLocationController::getCityById($data['location_id']);
		$location = UsersLocationController::createLocation([
			'name' => $city->name,
			'city_flag' => 1,
			'state_flag' => 0,
			'country_flag' => 0,
		]);
		$data['location_id'] = $location->id;

		Arr::forget($data, ['country', 'state']);

		return $data;
	}

	public static function setLocationForEdit($data)
	{
		$data['state'] = 0;
		$data['country'] = 101;
		if($data['location_id']){
			$location = UsersLocationController::findById($data['location_id']);
			$city = UsersLocationController::getCityByCityName($location->name);
			$state = $city->state;
			$country = $state->country;
			$data['location_id'] = $city->id;
			$data['state'] = $state->id;
			$data['country'] = $country->id;
		}
		return $data;
	}
}
