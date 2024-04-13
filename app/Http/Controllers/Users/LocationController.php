<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public static function getAll()
	{
		return Location::all();
	}

	public static function findById(string $id)
	{
		return Location::find($id);
	}

	public static function findByName(string $name)
	{
		return Location::where('name', $name)->first();
	}

	public static function createLocation(array $details)
	{
		return Location::firstOrCreate($details);
	}

	public static function getCountries()
	{
		return Country::where('status', 'active')
						->orderBy('name')
						->get();
	}

	public static function getCountryByCountryName(string $name)
	{
		return Country::where([
						'name' => strtolower($name)
					])->first();
	}

	public static function getStatesByCountryId(int $countryId)
	{
		return State::where([
						'status' => 'active',
						'country_id' => $countryId,
					])
					->orderBy('name')
					->get();
	}

	public static function getCitiesByStateId(int $stateId)
	{
		return City::where([
						'status' => 'active',
						'state_id' => $stateId,
					])
					->orderBy('name')
					->get();
	}

	public static function getCitiesByCountry(int $countryId)
	{
		return Country::whereHas('cities', function (Builder $query) {
								$query->where('cities.status', 'active');
							})
							->where([
								['id', $countryId],
								['status', 'active']
							])
							->first()
							->cities;
	}

	public static function getCityByCityName(string $name)
	{
		return City::where([
						'name' => strtolower($name)
					])->first()
					->load('state.country');
	}

	public static function getCountryById(int $id)
	{
		return Country::find($id);
	}

	public static function getStateById(int $id)
	{
		return State::find($id);
	}

	public static function getCityById(int $id)
	{
		return City::find($id);
	}
}
