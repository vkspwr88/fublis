<?php

namespace App\Services;

use App\Models\Call;
use App\Models\Journalist;
use App\Models\Pitch;
use App\Models\Publication;
use Carbon\Carbon;
use Exception;

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
								->latest()
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
								->latest()
								->get();
		}
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
