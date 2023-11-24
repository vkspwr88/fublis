<?php

namespace App\Services;

use App\Http\Controllers\Users\InviteColleagueController;
use Exception;
use Illuminate\Support\Facades\DB;

class InviteColleagueService
{
	public function sendInvitation(array $data)
	{
		try{
			DB::beginTransaction();
			$inviteColleage = InviteColleagueController::create([
				'invited_by' => auth()->id(),
				'name' => $data['name'],
				'email' => $data['email'],
				'message' => $data['inviteMessage'],
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
}
