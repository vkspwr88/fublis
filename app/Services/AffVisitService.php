<?php

namespace App\Services;

use App\Models\AffVisit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AffVisitService{

	public static function setAffReferral(string $userID)
	{
		if(Session::has('aff_list_id') && Session::has('aff_visit_id') && Session::has('referral_id')){
			$affVisitID = Session::get('aff_visit_id');
			$referralID = Session::get('referral_id');
			$affVisit = AffVisit::find($affVisitID);
			if($affVisit){
				$affVisit->affReferral()->create([
					'user_id' => $userID,
					'referral_id' => $referralID,
				]);
				$affVisit->update([
					'is_converted' => true,
				]);
			}
		}
	}

	public static function getQueryBuilder()
	{
		return AffVisit::with([
				'affList' => [
					'affRegistration' => [
						'user'
					]
				]
			])
			->whereRelation(
				'affList.affRegistration.user', function (Builder $query) {
					$query->where([
						'users.id' => Auth::id(),
					]);
			});
	}
}
