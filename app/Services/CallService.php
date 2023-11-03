<?php

namespace App\Services;

use App\Http\Controllers\Users\Journalists\CallController;
use App\Http\Controllers\Users\TagController;
use Exception;
use Illuminate\Support\Facades\DB;

class CallService
{
	public function createInviteStory(array $details)
	{
		try{
            DB::beginTransaction();
			// create call
			$call = CallController::createCall([
				'journalist_id' => auth()->user()->journalist->id,
				'category_id' => $details['category'],
				'title' => $details['title'],
				'description' => $details['description'],
				'location_id' => $details['location'],
				'publication_id' => $details['publication'],
				'language_id' => $details['language'],
				'submission_end_date' => $details['submissionEndsDate'],
			]);
			// attach tags
			TagController::attachTags($call, [
				$call->category->name,
				$call->location->name,
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
			// update call
			$call = CallController::updateCall($details['callId'], [
				'category_id' => $details['category'],
				'title' => $details['title'],
				'description' => $details['description'],
				'location_id' => $details['location'],
				'publication_id' => $details['publication'],
				'language_id' => $details['language'],
				'submission_end_date' => $details['submissionEndsDate'],
			]);

			// attach tags
			TagController::attachTags($call, [
				$call->category->name,
				$call->location->name,
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

	public function filterSubmission(string $callId)
	{
		if($callId == ""){
			return [];
		}
	}
}
