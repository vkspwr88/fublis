<?php

namespace App\Services\Architects;

use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Models\Architect;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

			Architect::where('user_id', auth()->id())
						->update([
							'architect_position_id' => $details['position'],
							'location_id' => $details['location'],
							'about_me' => $details['aboutMe'],
						]);

			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate(auth()->user()->architect->profileImage(), [
					'image_type' => 'profile',
					'image_path' => FileController::upload($details['profileImage'], 'images/architects/profile'),
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

	public function updateCompany(array $details)
	{
		try{
			DB::beginTransaction();
			$company = auth()->user()->architect->company;
			$company->update([
						'name' => $details['company'],
						'website' => $details['website'],
						'location_id' => $details['location'],
						'twitter' => $details['twitter'] ?? null,
						'facebook' => $details['facebook'] ?? null,
						'instagram' => $details['instagram'] ?? null,
						'linkedin' => $details['linkedin'] ?? null,
						'about_me' => $details['aboutMe'],
					]);

			if(!empty($details['profileImage'])){
				ImageController::updateOrCreate($company->profileImage(), [
					'image_type' => 'logo',
					'image_path' => FileController::upload($details['profileImage'], 'images/companies/logos'),
				]);
			}

			DB::commit();
			//Storage::delete('file.jpg');
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
}
