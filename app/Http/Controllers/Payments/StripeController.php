<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
use App\Mail\Admin\PaidUser;
use App\Models\SubscriptionPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
	public function checkout(Request $request, SubscriptionPlan $subscriptionPlan)
	{
		$user = $request->user();
		$stripeCustomer = $user->createOrGetStripeCustomer();

		return view('users.pages.architects.payments.stripe.checkout', [
			'intent' => $user->createSetupIntent(),
			'paymentMethod' => $user->defaultPaymentMethod(),
			'subscriptionPlan' => $subscriptionPlan,
		]);
	}

	public function callback(Request $request, SubscriptionPlan $subscriptionPlan)
	{
		try{
			// dd($request->all());
			$paymentMethod = '';
			$user = $request->user();
			if($request->payment_type == 'new'){
				$paymentMethod = $request->token;
			}
			elseif($request->payment_type == 'old'){
				$paymentMethod = $user->defaultPaymentMethod();
			}
			$subscription = $request->user()
									->newSubscription($subscriptionPlan->slug, $subscriptionPlan->price_id)
									// ->quantity($subscriptionPlan->quantity)
									->create($paymentMethod, [
										'email' => auth()->user()->email,
									], [
										'metadata' => ['plan' => str()->headline($subscriptionPlan->slug)],
									]);


			// Send mail to the admin
			Mail::to(env('COMPANY_EMAIL'))
				->cc('amansaini87@rediffmail.com')
				->cc('Vikas@re-thinkingthefuture.com')
				->queue(new PaidUser(auth()->user()));
			return to_route('architect.account.profile.setting.billing')->with([
				'type' => 'success',
				'message' => 'You have successfully subscribed to ' . str()->headline($subscriptionPlan->slug),
			]);
		}
		catch(Exception $exp){
			ErrorLogController::logErrorNew('stripe callback', $exp);
		}
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
