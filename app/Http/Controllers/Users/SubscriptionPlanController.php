<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public static function getAll()
    {
        return SubscriptionPlan::with('subscriptionPrices')->get();
    }

    public function index()
    {
        return view('users.pages.pricing');
    }
}
