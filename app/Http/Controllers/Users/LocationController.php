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

	public static function createLocation(array $details)
	{
		return Location::firstOrCreate($details);
	}

	public static function getCountries()
	{
		//dd(Country::with('cities')->orderBy('name')->get());
		/* return Country::with('cities')
						->orderBy('name')
						->get(); */
		return Country::where('status', 'active')
						->orderBy('name')
						->get();

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
}
