<?php

namespace App\Services;

use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\LocationController;
use App\Models\Call;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Journalist;
use App\Models\Pitch;
use App\Models\Publication;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
			$cities = LocationController::getCitiesByCountry($data['location']);
			$filter = Publication::whereHas('location', function(Builder $query) use($cities) {
				$query->whereIn('name', $cities->pluck('name'));
			})->get()->pluck('id');
			$publications = $publications->find($filter);
			// dd($data['location'], $cities, $filter);
			// $publications = $publications->where('location_id', $data['location']);
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
		// dd($publications);
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
			// $journalists = $journalists->where('location_id', $data['location']);
			$cities = LocationController::getCitiesByCountry($data['location']);
			$filter = Journalist::whereHas('location', function(Builder $query) use($cities) {
				$query->whereIn('name', $cities->pluck('name'));
			})->get()->pluck('id');
			dd($data['location'], $cities, $filter, $journalists);
			$journalists = $journalists->find($filter);
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
		$calls = Call::with([
							'publication' => [
								'profileImage'
							],
							'journalist' => [
								'user'
							],
							'category',
							'language',
							'location',
						])
						->where('submission_end_date', '>', Carbon::now())
						->where('title', 'like', '%' . $data['name'] . '%')
						->latest()
						->get();

		if($data['location'] != ''){
			$country = LocationController::getCountryById($data['location']);
			$filter = Call::whereHas('location', function(Builder $query) use($country) {
				$query->where('name', $country->name);
			})->get()->pluck('id');
			// dd($calls, $country, $filter);
			$calls = $calls->find($filter);
			// dd($calls, $filter);
			// $calls = $calls->where('location_id', $data['location']);
		}

		if($data['deadline'] != '' && get_class($data['deadline']) == 'Carbon\Carbon'){
			// dd('deadline', $data['deadline']);
			$calls = $calls->where('submission_end_date', '<=', $data['deadline']);
		}

		if(!empty($data['publicationTypes'])){
			// dd('publicationTypes');
			$publications = Publication::whereHas('publicationTypes', function(Builder $query) use($data) {
				$query->whereIn('publication_type_id', $data['publicationTypes']);
			})->get()->pluck('id');
			$filter = Call::whereHas('publication', function(Builder $query) use($publications) {
				$query->whereIn('id', $publications);
			})->get()->pluck('id');
			$calls = $calls->find($filter);
		}

		if(!empty($data['categories'])){
			// dd('categories');
			$calls = $calls->whereIn('category_id', $data['categories']);
		}

		return $calls;
	}

	public function createPitchStory($model, array $details)
	{
		try{
			DB::beginTransaction();
			$pitch = $model->pitches()->create([
				'journalist_id' => $details['journalist'],
				'media_kit_id' => $details['mediaKit'],
				'subject' => $details['subject'],
				'message' => $details['message'],
				'publication_id' => $details['publicationId'],
			]);

			$journalist = Journalist::find($details['journalist']);

			$chatService = new ChatService;

			$chat = $chatService->createChat([
				'pitch_id' => $pitch->id,
				'sender_id' => auth()->id(),
				'receiver_id' => $journalist->user_id,
				'sender_unread' => 0,
			]);

			$chatService->createChatMessage([
				'chat_id' => $chat->id,
				'user_id' => auth()->id(),
				'message' => $details['message'],
			], false);

			if($model instanceof Call){
				NotificationService::sendMediaKitOnCallNotification([
					'call_slug' => $model->slug,
					'call_title' => $model->title,
					'sent_to_user_id' => $journalist->user_id,
					'poly' => $pitch,
				]);
			}
			else{
				NotificationService::sendMediaKitNotification([
					'media_kit_type' => $details['mediaKitType'],
					'media_kit_slug' => $details['mediaKitSlug'],
					'media_kit_title' => $details['mediaKitTitle'],
					'sent_to_user_id' => $journalist->user_id,
					'message' => $details['message'],
					// 'poly' => $pitch,
					'poly' => $pitch,
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'createPitchStory', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
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
