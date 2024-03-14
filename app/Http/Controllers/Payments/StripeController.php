<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPrice;
use Illuminate\Http\Request;

class StripeController extends Controller
{
	/* public function index(Request $request)
	{
		$user = $request->user();
		$stripeCustomer = $user->createOrGetStripeCustomer();
		// dd($stripeCustomer);
		return view('users.pages.architects.payments.stripe.index', [
			'intent' => $user->createSetupIntent(),
		]);
	} */

	/* public function subscribe(Request $request, SubscriptionPrice $subscriptionPrice)
	{
		$user = $request->user();
		$stripeCustomer = $user->createOrGetStripeCustomer();
	} */

    public function checkout(Request $request, SubscriptionPrice $subscriptionPrice)
	{
		$user = $request->user();
		$stripeCustomer = $user->createOrGetStripeCustomer();
		// dd($subscriptionPrice->load('subscriptionPlan'));
		return view('users.pages.architects.payments.stripe.checkout', [
			'intent' => $user->createSetupIntent(),
			'subscriptionPrice' => $subscriptionPrice->load('subscriptionPlan'),
		]);
	}

	public function callback(Request $request, SubscriptionPrice $subscriptionPrice)
	{
		// dd($request->plan, $subscriptionPrice);
		$subscription = $request->user()
								->newSubscription($subscriptionPrice->slug, $subscriptionPrice->price_id)
								->quantity($subscriptionPrice->quantity)
								->create($request->token, [
									'email' => auth()->user()->email,
								], [
									'metadata' => ['plan' => str()->headline($subscriptionPrice->slug)],
								]);

		return to_route('architect.account.profile.setting.billing')->with([
			'type' => 'success',
			'message' => 'You have successfully subscribed to ' . str()->headline($subscriptionPrice->slug),
		]);
	}

	public function downloadInvoice(Request $request, string $invoiceId)
	{
		return $request->user()->downloadInvoice($invoiceId, [
			'vendor' => env('COMPANY_NAME'),
			// 'product' => 'Your Product',
			'street' => env('COMPANY_STREET'),
			'location' => env('COMPANY_LOCATION'),
			// 'phone' => '+32 499 00 00 00',
			'email' => env('COMPANY_EMAIL'),
			'url' => env('APP_URL'),
		], $invoiceId);
	}
}
