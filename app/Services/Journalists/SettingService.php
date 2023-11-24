<?php

namespace App\Services\Journalists;

use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
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

			Journalist::where('user_id', auth()->id())
						->update([
							'journalist_position_id' => $details['position'],
							'language_id' => $details['language'],
							'location_id' => $details['location'],
							'about_me' => $details['aboutMe'],
						]);

			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate(auth()->user()->journalist->profileImage(), [
					'image_type' => 'profile',
					'image_path' => FileController::upload($details['profileImage'], 'images/journalists/profile'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public function updatePublication(array $details)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			if($details['new']){
				$publication = PublicationController::createPublication([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $details['location'],
					'language_id' => $details['language'],
					'about_me' => $details['aboutMe'],
					'added_by' => $journalist->id,
				]);
				// journalist position in publication
				$journalist->publications()->attach($publication->id, [
					'journalist_position_id' => $details['position'],
				]);
				// publication categories
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
			}
			else{
				$publication = PublicationController::findById($details['publicationId']);
				$publication->update([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $details['location'],
					'language_id' => $details['language'],
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
			}

			// publication logo
			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate($publication->profileImage(), [
					'image_type' => 'logo',
					'image_path' => FileController::upload($details['profileImage'], 'images/publications/logos'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
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
			dd($exp->getMessage());
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
			dd($exp->getMessage());
			return false;
		}
		return true;
	}

	public function updateAssociatedPublication(array $details)
	{
		try{
			DB::beginTransaction();
			$journalist = auth()->user()->journalist;
			if($details['new']){
				$publication = PublicationController::createPublication([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $details['location'],
					'language_id' => $details['language'],
					'about_me' => $details['aboutMe'],
					'added_by' => $journalist->id,
				]);
				// journalist position in publication
				$journalist->associatedPublications()->attach($publication->id, [
					'journalist_position_id' => $details['position'],
				]);
				// publication categories
				$publication->categories()->sync($details['selectedCategories']);
				// publication types
				$publication->publicationTypes()->sync($details['selectedPublicationTypes']);
			}
			else{
				$publication = PublicationController::findById($details['publicationId']);
				$publication->update([
					'name' => $details['publicationName'],
					'website' => $details['website'],
					'location_id' => $details['location'],
					'language_id' => $details['language'],
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
			}

			// publication logo
			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate($publication->profileImage(), [
					'image_type' => 'logo',
					'image_path' => FileController::upload($details['profileImage'], 'images/publications/logos'),
				]);
			}

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			dd($exp->getMessage());
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
			dd($exp->getMessage());
			return false;
		}
		return true;
	}
}
