<?php

namespace App\Services;

use App\Http\Controllers\Users\InviteColleagueController;
use App\Mail\User\InvitationMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
			Mail::to($inviteColleage->email)->queue(new InvitationMail($inviteColleage, $data['type']));
			NotificationService::sendTeamInviteNotification([
				'poly' => $inviteColleage,
				'invited_by' => auth()->user()->name,
				'invited_to' => $data['name'],
				'type' => $data['type'],
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
