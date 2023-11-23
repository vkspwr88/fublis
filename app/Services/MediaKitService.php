<?php

namespace App\Services;

use App\Models\Call;
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
		if(!empty($data['categories'])){
			$mediaKits = $mediaKits->whereIn('category_id', $data['categories']);
		}
		if(!empty($data['mediaKitTypes'])){
			$mediaKits = $mediaKits->whereIn('story_type', $data['mediaKitTypes']);
		}
		//dd($mediaKits);
		return $mediaKits;
	}

	public function filterSubmission(array $data)
	{
		$mediaKits = MediaKit::with([
								'story',
								'category',
								'architect.company',
								'pitch.pitchable',
							])
							->whereHas('pitch')
							/* ->where([
								['journalist_id', auth()->user()->journalist->id],
								['title', 'like', '%' . $data['name'] . '%']
							]) */
							->whereHasMorph(
								'pitch.pitchable',
								Call::class,
								function (Builder $query) use($data) {
									$query->where([
										['journalist_id', auth()->user()->journalist->id],
										['title', 'like', '%' . $data['name'] . '%']
									]);
								}
							)
							->latest()
							->get();
		if($data['call'] != ""){
			return [];
		}
		dd($mediaKits);
		return $mediaKits;
	}
}
