<?php

namespace App\Services;

use App\Models\MediaKit;
use Illuminate\Database\Eloquent\Builder;

class MediaKitService
{
	public function filterMediaKits(array $data)
	{
		$mediaKits = MediaKit::with(['story', 'category', 'architect.company'])
								->where('architect_id', auth()->user()->architect->id)
								->whereHas('story', function(Builder $query) use($data) {
									$query->where('title', 'like', '%' . $data['name'] . '%');
								})
								->latest()
								->get();

		if(!empty($data['categories'])){
			$mediaKits = $mediaKits->whereIn('category_id', $data['categories']);
		}
		if(!empty($data['mediaKitTypes'])){
			$mediaKits = $mediaKits->whereIn('story_type', $data['mediaKitTypes']);
		}
		//dd($data, $mediaKits);
		return $mediaKits;
	}

	public function filterAllMediaKits(array $data)
	{
		$mediaKits = MediaKit::with(['story', 'category', 'architect.company'])
								->whereHas('story', function(Builder $query) use($data) {
									$query->where('title', 'like', '%' . $data['name'] . '%');
								})
								->latest()
								->get();
		/* if(empty($data['location']) && empty($data['mediaKits']) && empty($data['categories'])){
			return MediaKit::with(['story', 'category', 'architect.company'])
							->latest()
							->get();
		} */
		if(!empty($data['categories'])){
			$mediaKits = $mediaKits->whereIn('category_id', $data['categories']);
		}
		if(!empty($data['mediaKitTypes'])){
			$mediaKits = $mediaKits->whereIn('story_type', $data['mediaKitTypes']);
		}
		return $mediaKits;
	}
}
