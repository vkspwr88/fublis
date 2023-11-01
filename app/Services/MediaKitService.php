<?php

namespace App\Services;

use App\Models\MediaKit;

class MediaKitService
{
	public function filterMediaKits(array $mediaKitTypes, array $categories)
	{
		if(empty($mediaKitTypes) && empty($categories)){
			return MediaKit::with(['story', 'category', 'architect.company'])
							->where('architect_id', auth()->user()->architect->id)
							->latest()
							->get();
		}
	}

	public function filterAllMediaKits(array $data)
	{
		if(empty($data['location']) && empty($data['mediaKits']) && empty($data['categories'])){
			return MediaKit::with(['story', 'category', 'architect.company'])
							->latest()
							->get();
		}
	}
}
