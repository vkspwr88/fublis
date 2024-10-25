<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\LocationController as UsersLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LocationController extends Controller
{
    public static function setLocationForCreate($data, $onlyCountry = false)
	{
		$country = UsersLocationController::getCountryById($data['country']);
		if($onlyCountry){
			$location = UsersLocationController::createLocation([
				'name' => $country->name,
				'city_flag' => 0,
				'state_flag' => 0,
				'country_flag' => 1,
			]);
			$data['location_id'] = $location->id;

			Arr::forget($data, ['country']);
		}
		else{
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
		}

		return $data;
	}

	public static function setLocationForEdit($data, $onlyCountry = false)
	{
		$data['country'] = 101;
		if($onlyCountry){
			if($data['location_id']){
				$location = UsersLocationController::findById($data['location_id']);
				$country = UsersLocationController::getCountryByCountryName($location->name);
				if($country){
					$data['country'] = $country->id;
				}
			}
		}
		else{
			$data['state'] = 0;
			if($data['location_id']){
				$location = UsersLocationController::findById($data['location_id']);
				$city = UsersLocationController::getCityByCityName($location->name);
				// dd($location, $city, $data);
				if($city && $city->state){
					$state = $city->state;
					$data['state'] = $state->id;
					if($state && $state->country){
						$country = $state->country;
						$data['country'] = $country->id;
					}
				}
				if($city->id){
					$data['location_id'] = $city->id;
				}
				// dd($data);
			}
		}

		return $data;
	}
}
