<?php

namespace App\Services\Architects;

use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Models\Architect;
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

			Architect::where('user_id', auth()->id())
						->update([
							'architect_position_id' => $details['position'],
							'location_id' => $details['location'],
							'about_me' => $details['aboutMe'],
						]);

			if(!empty($details['profileImage'])){
				ImageController::create(auth()->user()->architect->profileImage(), [
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
}
