<?php

namespace App\Services\Journalists;

use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\AvatarController;
use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Models\Journalist;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class SettingService
{
	public function updatePersonalInfo(array $details)
	{
		try{
			DB::beginTransaction();
			User::where('id', auth()->id())
					->update([
						'name' => $details['name'],
						'email' => $details['email'],
					]);

			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCity'],
			]);
			Journalist::where('user_id', auth()->id())
						->update([
							'journalist_position_id' => $details['position'],
							'language_id' => $details['language'],
							'location_id' => $location->id,
							'about_me' => $details['aboutMe'],
						]);

			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate(auth()->user()->journalist->profileImage(), [
					'image_type' => 'profile',
					'image_path' => FileController::upload($details['profileImage'], 'images/journalists/profile', 'journalist_profile'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'updatePersonalInfo - Journalist', [
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

	public function updatePublication(array $details)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCountry'],
				'country_flag' => 1,
				'state_flag' => 0,
				'city_flag' => 0,
			]);
			if($details['new']){
				$publication = PublicationController::createPublication([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					// 'language_id' => $details['language'],
					'monthly_visitors' => $details['monthlyVisitors'],
					'about_me' => $details['aboutMe'],
					'starting_year' => $details['startingYear'],
					'added_by' => $journalist->id,
					'background_color' => AvatarController::getBackground('publication'),
					'foreground_color' => '#ffffff',
				]);
				// journalist position in publication
				$journalist->publications()->attach($publication->id, [
					'journalist_position_id' => $details['position'],
				]);
				// publication categories
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
				// publish from
				$publication->publishFrom()->sync($details['selectedPublishFrom']);
				// publication languages
				$publication->languages()->sync($details['selectedLanguages']);
			}
			else{
				$publication = PublicationController::findById($details['publicationId']);
				$publication->update([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					// 'language_id' => $details['language'],
					'monthly_visitors' => $details['monthlyVisitors'],
					'starting_year' => $details['startingYear'],
					'about_me' => $details['aboutMe'],
				]);
				// journalist position in publication
				$journalist->publications()
							->syncWithoutDetaching([
								$publication->id => [
									'journalist_position_id' => $details['position'],
								],
							]);

				// publication categories
				//$publication->categories()->detach();
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
				// publish from
				$publication->publishFrom()->sync($details['selectedPublishFrom']);
				// publication languages
				$publication->languages()->sync($details['selectedLanguages']);
			}

			// publication logo
			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate($publication->profileImage(), [
					'image_type' => 'logo',
					'image_path' => FileController::upload($details['profileImage'], 'images/publications/logos', 'publication_logo'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'updatePublication', [
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

	public function deletePublication(string $publicationId)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			$journalist->publications()->detach($publicationId);
			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'deletePublication', [
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

	public function updatePassword(array $details)
	{
		try{
			DB::beginTransaction();

			$updated = User::find(auth()->id())
							->update([
								'password' => $details['newPassword'],
							]);

			throw_if(
				!$updated,
				Exception::class,
				'Unable to update password.',
			);

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'updatePassword - Journalist', [
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

	public function updateAssociatedPublication(array $details)
	{
		try{
			DB::beginTransaction();
			// insert location record
			$location = LocationController::createLocation([
				'name' => $details['selectedCountry'],
				'country_flag' => 1,
				'state_flag' => 0,
				'city_flag' => 0,
			]);
			$journalist = auth()->user()->journalist;
			if($details['new']){
				$publication = PublicationController::createPublication([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					'monthly_visitors' => $details['monthlyVisitors'],
					// 'language_id' => $details['language'],
					'starting_year' => $details['startingYear'],
					'about_me' => $details['aboutMe'],
					'added_by' => $journalist->id,
					'background_color' => AvatarController::getBackground('publication'),
					'foreground_color' => '#ffffff',
				]);
				// journalist position in publication
				$journalist->associatedPublications()->attach($publication->id, [
					'journalist_position_id' => $details['position'],
				]);
				// publication categories
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
				// publish from
				$publication->publishFrom()->sync($details['selectedPublishFrom']);
				// publication languages
				$publication->languages()->sync($details['selectedLanguages']);
			}
			else{
				$publication = PublicationController::findById($details['publicationId']);
				$publication->update([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $location->id,
					'monthly_visitors' => $details['monthlyVisitors'],
					// 'language_id' => $details['language'],
					'about_me' => $details['aboutMe'],
				]);
				// journalist position in publication
				$journalist->publications()
							->syncWithoutDetaching([
								$publication->id => [
									'journalist_position_id' => $details['position'],
								],
							]);

				// publication categories
				//$publication->categories()->detach();
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
				// publish from
				$publication->publishFrom()->sync($details['selectedPublishFrom']);
				// publication languages
				$publication->languages()->sync($details['selectedLanguages']);
			}

			// publication logo
			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate($publication->profileImage(), [
					'image_type' => 'logo',
					'image_path' => FileController::upload($details['profileImage'], 'images/publications/logos', 'associated_publication_logo'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'updateAssociatedPublication', [
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

	public function deleteAssociatedPublication(string $publicationId)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			$journalist->associatedPublications()->detach($publicationId);
			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'deleteAssociatedPublication', [
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

	public function addAssociatedPublication(array $details)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			$journalist->associatedPublications()->attach(
				$details['publication_id'], [
					'journalist_position_id' => $details['journalist_position_id'],
				]);
			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'addAssociatedPublication', [
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
}
