<?php

namespace App\Services;

use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TagController;
use App\Models\Image;
use App\Models\PressRelease;
use Exception;
use Illuminate\Support\Facades\DB;

class AddStoryService
{
	public function addPressRelease(array $details)
	{
		try{
            DB::beginTransaction();
			// create press release
			$pressRelease = PressRelease::create([
				'cover_image_path' => FileController::upload($details['coverImage'], 'images/press-releases/cover-images'),
				'title' => $details['pressReleaseTitle'],
				'image_credits' => $details['imageCredits'],
				'concept_note' => $details['conceptNote'],
				'press_release_writeup' => $details['pressReleaseWrite'],
				'press_release_doc_path' => $details['pressReleaseFile'] ? FileController::upload($details['pressReleaseFile'], 'docs/press-releases') : null,
				'press_release_doc_link' => $details['pressReleaseLink'],
				'photographs_link' => $details['photographsLink'],
			]);
			// create media kit
			$pressRelease->mediakit()
							->create([
								'architect_id' => auth()->user()->architect->id,
								'category_id' => $details['category'],
							]);
			// create images
			if(count($details['photographsFiles']) > 0){
				foreach($details['photographsFiles'] as $photograph){
					ImageController::create($pressRelease->photographs(), [
						'image_type' => 'photographs',
						'image_path' => FileController::upload($photograph, 'images/press-releases/photographs'),
					]);
				}
			}
			// create tags
			TagController::attachTags($pressRelease, $details['tags']);

			DB::commit();
		}
		catch(Exception $exp){
            DB::rollBack();

			dd($exp->getMessage());
            //Session::flash('message', $exp->getMessage());
            //Session::flash('message', 'Unable to process the order. Please contact support.');
            //Session::flash('alert-class', 'alert-danger');
            return false;
        }
		return true;
	}
}
