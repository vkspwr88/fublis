<?php

namespace App\Services;

use App\Enums\Affiliates\ReturnTypeEnum;
use App\Models\AffReferral;
use App\Models\SubscriptionPlan;
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
		$subscriptionCurrency = 'USD';

		if($commissionType === ReturnTypeEnum::PERCENTAGE){
			$subscriptionAmount = $subscriptionPrice->price_per_month * $subscriptionPrice->quantity;
			$subscriptionCurrency = $subscriptionPrice->currency;

			// Retrieve usd amount from database
			$usdSubscription = SubscriptionPlan::where([
				'plan_type' => $subscriptionPrice->plan_type,
				'currency' => 'USD',
			])->first();
			if($usdSubscription){
				$subscriptionAmount = $usdSubscription->price_per_month * $usdSubscription->quantity;
				$subscriptionCurrency = $usdSubscription->currency;
			}
			
			$commissionAmount = ($subscriptionAmount * $commissionValue) / 100;
		}
		$affReferral->update([
			'earned_amount' => $commissionAmount,
			'earned_currency' => $subscriptionCurrency,
			'description' => $subscriptionPrice->plan_name,
		]);
	}

	public static function getQueryBuilder()
	{
		return AffReferral::with(['affVisit', 'user'])
			->where('referral_id', Auth::id());
	}
}
