<?php

namespace App\Services;

use App\Http\Controllers\Users\Journalists\CallController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\TagController;
use App\Models\Call;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CallService
{
	public function createInviteStory(array $details)
	{
		try{
            DB::beginTransaction();
			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCountry'],
				'country_flag' => true,
				'state_flag' => false,
				'city_flag' => false,
				// 'name' => $details['selectedCity'],
			]);
			// create call
			$call = CallController::createCall([
				'journalist_id' => auth()->user()->journalist->id,
				'category_id' => $details['category'],
				'title' => $details['title'],
				'slug' => $this->generateSlug($details['title']),
				'description' => $details['description'],
				'location_id' => $location->id,
				'publication_id' => $details['publication'],
				'language_id' => $details['language'],
				'publish_from_id' => $details['selectedPublishFrom'],
				'submission_end_date' => Carbon::parse($details['submissionEndsDate']),
			]);
			// attach tags
			TagController::attachTags($call, [
				$call->category->name,
				$location->name,
				$call->language->name,
			]);
			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			dd($exp->getMessage());
            return false;
        }
		return true;
	}

	public function editInviteStory(array $details)
	{
		try{
            DB::beginTransaction();
			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCountry'],
				'country_flag' => true,
				'state_flag' => false,
				'city_flag' => false,
				// 'name' => $details['selectedCity'],
			]);
			// update call
			$call = CallController::updateCall($details['callId'], [
				'category_id' => $details['category'],
				'title' => $details['title'],
				'description' => $details['description'],
				'location_id' => $location->id,
				'publication_id' => $details['publication'],
				'language_id' => $details['language'],
				'publish_from_id' => $details['selectedPublishFrom'],
				'submission_end_date' => Carbon::parse($details['submissionEndsDate']),
			]);

			// attach tags
			TagController::attachTags($call, [
				$call->category->name,
				$location->name,
				$call->language->name,
			]);
			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();
			dd($exp->getMessage());
            return false;
        }
		return true;
	}

	public function filterSubmission(array $data)
	{
		$submissions = Call::with([
								'pitches',
								'mediaKits' => [
									'story',
									'category',
									'architect.company'
								],
							])
							->where('journalist_id', auth()->user()->journalist->id)
							->whereHas(
								'mediaKits',
							)
							->latest()
							->get();
		if($data['call'] != ""){
			$submissions = $submissions->find($data['call']);
		}
		//dd($data, $submissions, $submissions->mediaKits);
		return $submissions;
	}

	public function generateSlug($title)
	{
		$count = Call::where('title', $title)->count();
		if($count > 1){
			$title .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($title)
						);
	}

	public function searchCalls(array $data)
	{
		return Call::whereHas('journalist', function(Builder $query) use($data){
						$query->where([
							['journalist_id', auth()->user()->journalist->id],
							['title', 'like', '%' . $data['name'] . '%']
						]);
					})
					->latest()
					->get();
	}
}
