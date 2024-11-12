<?php

namespace App\Services;

use App\Enums\Affiliates\ReturnTypeEnum;
use App\Models\AffList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AffListService
{
	public static function getRecordByUsername(string $username): ?AffList
	{
		return AffList::where('username', $username)->first();
	}

	public static function setSession($request)
	{
		$affList = self::getRecordByUsername($request->ref);
		if($affList){
			$affVisit = $affList->affVisits()->create([
				'campaign' => $request->campaign ?? null,
				'ip_address' => $request->ip() ?? null,
			]);
			Session::put('referral_id', $affList->affRegistration->user->id);
			Session::put('aff_list_id', $affList->id);
			Session::put('aff_visit_id', $affVisit->id);
		}
	}

	public static function getCommissionRate()
	{
		$user = Auth::user();
		$affRegistration = $user->affRegistration;
		$defaultValue = '0%';
		if(!$affRegistration){
			return $defaultValue;
		}
		$affList = $affRegistration->affList;
		if(!$affList){
			return $defaultValue;
		}

		$commissionType = $affList->return_type;
		$commissionValue = $affList->return_value;

		if($commissionType === ReturnTypeEnum::PERCENTAGE){
			return $commissionValue . '%';
		}

		return displayCurrencyValue($commissionValue);
	}
}
