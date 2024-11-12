<?php

namespace App\Services;

use App\Enums\Affiliates\ReturnTypeEnum;
use App\Models\AffReferral;
use Illuminate\Support\Facades\Auth;

class AffReferralService
{
	public static function updateAmountEarned($user, $subscription)
	{
		$affReferral = $user->affReferral;
		if(!$affReferral){
			return;
		}
		$affVisit = $affReferral->affVisit;
		if(!$affVisit){
			return;
		}
		$affList = $affVisit->affList;
		if(!$affList){
			return;
		}
		$subscriptionPrice = $subscription->subscriptionPrice;
		if(!$subscriptionPrice){
			return;
		}

		$commissionType = $affList->return_type;
		$commissionValue = $affList->return_value;

		// By default set commission type fixed and set the value
		$commissionAmount = $commissionValue;

		$subscriptionAmount = $subscriptionPrice->price_per_month * $subscriptionPrice->quantity;
		if($commissionType === ReturnTypeEnum::PERCENTAGE){
			$commissionAmount = ($subscriptionAmount * $commissionValue) / 100;
		}
		$affReferral->update([
			'earned_amount' => $commissionAmount,
			'earned_currency' => $subscriptionPrice->currency,
			'description' => $subscriptionPrice->plan_name,
		]);
	}

	public static function getQueryBuilder()
	{
		return AffReferral::with(['affVisit', 'user'])
			->where('referral_id', Auth::id());
	}
}
