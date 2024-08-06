<?php

namespace App\Services;

use App\Http\Controllers\Users\LocationController;
use App\Models\Call;
use App\Models\MediaKit;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
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
		$mediaKits = MediaKit::with(['story', 'category', 'architect.company.profileImage'])
								->whereHas('story', function(Builder $query) use($data) {
									$query->where('title', 'like', '%' . $data['name'] . '%');
								})
								->latest()
								->get();

		if($data['location'] != ''){
			$cities = LocationController::getCitiesByCountry($data['location']);
			$filter1 = MediaKit::whereHasMorph(
				'story',
				[Project::class],
				function (Builder $query) use($cities) {
					// dd($query->location());
					// $column = $type === Post::class ? 'content' : 'title';

					$query->whereHas('location', function(Builder $query2) use($cities) {
						$query2->whereIn('name', $cities->pluck('name'));
						// $query->where('title', 'like', '%' . $data['name'] . '%');
					});
				}
			)
			->get()
			->pluck('id');

			$filter2 = MediaKit::whereHasMorph(
				'story',
				[Project::class],
				function (Builder $query) use($data) {
					$country = LocationController::getCountryById($data['location']);
					// dd($data['location'], $query->where('location_id', $data['location']));
					$query->whereHas('location', function(Builder $query2) use($country) {
						$query2->where('name', $country->name);
						// $query->where('title', 'like', '%' . $data['name'] . '%');
					});
				}
			)
			->get()
			->pluck('id');

			$filter = $filter1->merge($filter2);
			// dd($mediaKits, $filter1, $filter2, $filter);
			$mediaKits = $mediaKits->find($filter);
		}
		if(!empty($data['categories'])){
			// dd('category');
			$mediaKits = $mediaKits->whereIn('category_id', $data['categories']);
		}
		if(!empty($data['mediaKitTypes'])){
			// dd('mediaKitTypes');
			$mediaKits = $mediaKits->whereIn('story_type', $data['mediaKitTypes']);
		}
		// dd($mediaKits->count(), $mediaKits);
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

	public static function getTodayMediaKits()
	{
		/* $startDate = Carbon::now()->startOfDay();
		$endDate = Carbon::now()->endOfDay();
		return MediaKit::whereBetween('created_at', [$startDate, $endDate])
			->get(); */
		$startDate = Carbon::now()->startOfDay();
		$endDate = Carbon::now()->endOfDay();
		return User::with([
				'journalist' => [
					'publications.categories.mediaKits.story',
					'associatedPublications.categories.mediaKits.story',
				],
			])
			->whereHas('journalist.publications.categories.mediaKits', function (Builder $query) use ($startDate, $endDate) {
				$query->whereBetween('created_at', [$startDate, $endDate]);
			})->orWhereHas('journalist.associatedPublications.categories.mediaKits', function (Builder $query) use ($startDate, $endDate) {
				$query->whereBetween('created_at', [$startDate, $endDate]);
			})
			->get();
	}

	public static function loadModel($model)
	{
		return $model->load([
			'category' => [
				'publications' => [
					'journalists' => [
						'user'
					],
					'associatedJournalists' => [
						'user'
					],
				],
			],
		]);
	}
}
