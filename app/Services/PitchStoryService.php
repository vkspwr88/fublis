<?php

namespace App\Services;

use App\Models\Call;
use App\Models\Journalist;
use App\Models\Pitch;
use App\Models\Publication;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class PitchStoryService
{
	public function filterPublications(array $data)
	{
		$publications = Publication::with([
										'profileImage',
										'location',
										'categories',
										'publicationTypes',
										'language',
									])
									->where('name', 'like', '%' . $data['name'] . '%')
									->latest()
									->get();

		if($data['location'] != ''){
			$publications = $publications->where('location_id', $data['location']);
		}

		if(!empty($data['publicationTypes'])){
			$filter = Publication::whereHas('publicationTypes', function(Builder $query) use($data) {
				$query->whereIn('publication_type_id', $data['publicationTypes']);
			})->get()->pluck('id');
			$publications = $publications->find($filter);
		}

		if(!empty($data['categories'])){
			$filter = Publication::whereHas('categories', function(Builder $query) use($data) {
				$query->whereIn('category_id', $data['categories']);
			})->get()->pluck('id');
			$publications = $publications->find($filter);
		}

		return $publications;
	}

	public function filterJournalists(array $data)
	{
		$journalists = Journalist::with([
										'profileImage',
										'user',
										'location',
										'position',
										'publications' => [
											'profileImage',
											'location',
											'categories',
											'publicationTypes',
										],
									])
									->whereHas('user', function(Builder $query) use($data) {
										$query->where('name', 'like', '%' . $data['name'] . '%');
									})
									->latest()
									->get();

		if($data['location'] != ''){
			$journalists = $journalists->where('location_id', $data['location']);
		}

		if(!empty($data['publicationTypes'])){
			$publications = Publication::whereHas('publicationTypes', function(Builder $query) use($data) {
				$query->whereIn('publication_type_id', $data['publicationTypes']);
			})->get()->pluck('id');
			$filter = Journalist::whereHas('publications', function(Builder $query) use($publications) {
				$query->whereIn('id', $publications);
			})->get()->pluck('id');
			$journalists = $journalists->find($filter);
		}

		if(!empty($data['positions'])){
			$journalists = $journalists->whereIn('journalist_position_id', $data['positions']);
		}

		if(!empty($data['categories'])){
			$publications = Publication::whereHas('categories', function(Builder $query) use($data) {
				$query->whereIn('category_id', $data['categories']);
			})->get()->pluck('id');
			$filter = Journalist::whereHas('publications', function(Builder $query) use($publications) {
				$query->whereIn('id', $publications);
			})->get()->pluck('id');
			$journalists = $journalists->find($filter);
		}

		return $journalists;
	}

	public function filterCalls(array $data)
	{
		if($data['location'] == '' && empty($data['publicationTypes']) && empty($data['categories'])){
			return Call::with([
							'publication' => [
								'profileImage'
							],
							'journalist' => [
								'user'
							],
							'category',
						])
						->where('submission_end_date', '>', Carbon::now())
						->latest()
						->get();
		}
	}

	public function createPitchStory($model, array $details)
	{
		try{
			$model->pitches()->create([
				'journalist_id' => $details['journalist'],
				'media_kit_id' => $details['mediaKit'],
				'subject' => $details['subject'],
				'message' => $details['message'],
			]);
		}
		catch(Exception $exp){
			dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public function isStoryPitched($journalistId, $mediaKitId)
	{
		return Pitch::where([
			'journalist_id' => $journalistId,
			'media_kit_id' => $mediaKitId,
		])->first();
	}
}
