<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use App\Services\AffListService;
use App\Services\AffReferralService;
use App\Services\AffVisitService;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(){
		$referralQuery = AffReferralService::getQueryBuilder();
		$totalUnpaidReferrals = $referralQuery->where('earned_amount', '=', 0)->count();
		$totalPaidReferrals = $referralQuery->where('earned_amount', '>', 0)->count();

		$totalEarnings = $referralQuery->sum('earned_amount');

		$totalPayouts = 0;

		$visitQuery = AffVisitService::getQueryBuilder();
		$totalVisits = $visitQuery->count();

		$commissionRate = AffListService::getCommissionRate();

		return view('users.pages.affiliates.stats', compact(
			'totalUnpaidReferrals', 'totalPaidReferrals', 'totalVisits', 'totalEarnings', 'totalPayouts', 'commissionRate'
		));
	}
}
