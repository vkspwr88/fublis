<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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
}
