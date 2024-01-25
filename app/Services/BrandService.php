<?php

namespace App\Services;

use App\Models\Company;

class BrandService
{
	public function filterAllBarnds(array $data)
	{
		$brands = Company::with([
								'mediaKit.story',
								'profileImage',
								'category',
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
			$brands = $brands->where('location_id', $data['location']);
		}
		if(!empty($data['categories'])){
			$brands = $brands->whereIn('category_id', $data['categories']);
		}

		return $brands;
	}
}
