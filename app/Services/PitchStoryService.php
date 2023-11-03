<?php

namespace App\Services;

use App\Models\Journalist;
use App\Models\Publication;

class PitchStoryService
{
	public function filterPublications(array $data)
	{
		if($data['location'] == '' && empty($data['publicationTypes']) && empty($data['categories'])){
			return Publication::with([
									'profileImage',
									'location',
									'categories',
								])
								->get();
		}
	}

	public function filterJournalists(array $data)
	{
		if($data['location'] == '' && empty($data['publicationTypes']) && empty($data['categories']) && empty($data['positions'])){
			return Journalist::with([
									'profileImage',
									'user',
									'position',
									'publications' => [
										'profileImage',
										'location',
										'categories',
									],
									//'location',
									//'categories',
								])
								->get();
		}
	}
}
