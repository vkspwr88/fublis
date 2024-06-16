<?php

namespace App\Services;

use App\Http\Controllers\Users\LocationController;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

class BrandService
{
	public function filterAllBarnds(array $data)
	{
		$brands = Company::with([
								'mediaKit.story',
								'profileImage',
								'category',
								'categories',
								'location'
							])
							// ->whereHas('mediaKit')
							->where('name', 'like', '%' . $data['name'] . '%')
							->latest()
							->get();

		/* if(empty($data['location']) && empty($data['categories'])){
			return Company::with([
								'mediaKit.story',
								'profileImage',
								'category',
								'location'
							])
							->whereHas('mediaKit')
							->get();
		} */
		if($data['location'] != ''){
			$country = LocationController::getCountryById($data['location']);
			$filter = Company::whereHas('location', function(Builder $query) use($country) {
				$query->where('name', $country->name);
			})->get()->pluck('id');
			// dd($calls, $country, $filter);
			$brands = $brands->find($filter);
			/* $cities = LocationController::getCitiesByCountry($data['location']);
			$filter = Company::whereHas('location', function(Builder $query) use($cities) {
				$query->whereIn('name', $cities->pluck('name'));
			})->get()->pluck('id');
			$brands = $brands->find($filter); */
			// $brands = $brands->where('location_id', $data['location']);
		}
		/* if(!empty($data['categories'])){
			$brands = $brands->whereIn('category_id', $data['categories']);
		} */
		if(!empty($data['categories'])){
			$filter1 = Company::whereHas('categories', function(Builder $query) use($data) {
				$query->whereIn('category_id', $data['categories']);
			})->get()->pluck('id');
			$filter2 = $brands->whereIn('category_id', $data['categories'])->pluck('id');
			$filter = $filter1->merge($filter2);
			$brands = $brands->find($filter);
		}

		return $brands;
	}
}
