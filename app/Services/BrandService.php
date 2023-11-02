<?php

namespace App\Services;

use App\Models\Company;

class BrandService
{
	public function filterAllBarnds(array $data)
	{
		if(empty($data['location']) && empty($data['categories'])){
			return Company::with([
								'mediaKit.story',
								'profileImage',
								'category',
								'location'
							])
							->whereHas('mediaKit')
							->get();
		}
	}
}
