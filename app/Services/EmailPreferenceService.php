<?php

namespace App\Services;

use App\Http\Controllers\ErrorLogController;
use App\Models\EmailPreference;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmailPreferenceService
{
	public static function getAllRecordsByUser($user)
	{
		return EmailPreference::where('email_for', $user)->get();
	}

	// selected means no record in the DB
	public static function getRecordsByUser($user)
	{
		$allRecords = self::getAllRecordsByUser($user);
		return [
			'all' => $allRecords,
			'selected' => self::filterSelectedRecords($allRecords->pluck('id'), User::find(Auth::id())->emailPreferences->pluck('id')),
		];
	}

	// means removing selected records
	public static function filterSelectedRecords($all, $selected): array
	{
		return $all->diff($selected)->flatten()->all();
	}

	public static function updateArchitect($emailPreferences)
	{
		$alert = [
			'type' => 'success',
			'message' => 'You have successfully updated the email preferences.',
		];
		try{
            DB::beginTransaction();

			User::find(Auth::id())->emailPreferences()->sync(
				self::filterSelectedRecords(self::getAllRecordsByUser('architect')->pluck('id'), $emailPreferences)
			);

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logErrorNew('update', $exp);
		}

		return $alert;
	}

	public static function updateJournalist($emailPreferences)
	{
		$alert = [
			'type' => 'success',
			'message' => 'You have successfully updated the email preferences.',
		];
		try{
            DB::beginTransaction();

			User::find(Auth::id())->emailPreferences()->sync(
				self::filterSelectedRecords(self::getAllRecordsByUser('journalist')->pluck('id'), $emailPreferences)
			);

			DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logErrorNew('update', $exp);
		}

		return $alert;
	}

	public static function isPreferenceSelected($user, $key)
	{
		return !$user->emailPreferences->firstWhere('key', $key);
	}
}
