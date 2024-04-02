<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public static function getAll()
    {
        return SubscriptionPlan::all();
    }

	public static function getRecordsByPlanType($planType)
	{
		return SubscriptionPlan::where('plan_type', $planType)->get();
	}

    public function index()
    {
        return view('users.pages.pricing', [
			'faqs' => FaqController::getAll(),
		]);
    }
}
