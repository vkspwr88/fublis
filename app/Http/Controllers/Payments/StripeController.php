<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
use App\Mail\Admin\PaidUser;
use App\Models\SubscriptionPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
	public function checkout(Request $request, SubscriptionPlan $subscriptionPlan)
	{
		$user = $request->user();
		$stripeCustomer = $user->createOrGetStripeCustomer();
		// dd($user->createSetupIntent(/* [
		// 	'amount' => $subscriptionPlan->price_per_month * $subscriptionPlan->quantity * 100,
		// 	'currency' => 'usd',
		// 	'payment_method_types' => ['card'],
		// 	'automatic_payment_methods' => ['enabled' => true]
		// ] */));
		return view('users.pages.architects.payments.stripe.checkout', [
			'intent' => $user->createSetupIntent(),
			// 'intent' => $user->payWith($subscriptionPlan->price_per_month * $subscriptionPlan->quantity * 100, ['card']),
			'paymentMethod' => $user->defaultPaymentMethod(),
			'subscriptionPlan' => $subscriptionPlan,
		]);
		/* return $request->user()
					->newSubscription($subscriptionPlan->slug, $subscriptionPlan->price_id)
					// ->trialDays(5)
					// ->allowPromotionCodes()
					->checkout([
						'success_url' => redirect()->route('architect.account.profile.setting.billing')->with([
							'type' => 'success',
							'message' => 'You have successfully subscribed to ' . str()->headline($subscriptionPlan->slug),
						])->getTargetUrl(),
						'cancel_url' => redirect()->route('pricing')->with([
							'type' => 'error',
							'message' => 'You have cancelled the payment',
						])->getTargetUrl(),
					]); */
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
				$paymentMethod = $user->defaultPaymentMethod()->id;
				// dd($paymentMethod);
			}
			$subscription = $request->user()
									->newSubscription($subscriptionPlan->slug, $subscriptionPlan->price_id)
									// ->quantity($subscriptionPlan->quantity)
									->create($paymentMethod, [
										'email' => auth()->user()->email,
									], [
										// 'off_session' => true,
										'metadata' => [
											'plan' => $subscriptionPlan->plan_name
										],
									]);


			/* if($request->payment_type == 'new'){
				$paymentIntent = PaymentIntent::retrieve($paymentMethod);
				if ($paymentIntent->status === 'requires_action') {
					return redirect()->route('cashier.payment', [
						'payment_intent_client_secret' => $paymentIntent->client_secret,
						'success_url' => redirect()->route('architect.account.profile.setting.billing')->with([
							'type' => 'success',
							'message' => 'You have successfully subscribed to ' . str()->headline($subscriptionPlan->slug),
						])->getTargetUrl(),
						'cancel_url' => redirect()->route('architect.stripe.checkout', ['subscriptionPlan' => $subscriptionPlan->slug])->with([
							'type' => 'error',
							'message' => 'You have cancelled the payment',
						])->getTargetUrl(),
					]);
				}

			} */

			// Send mail to the admin
			Mail::to(env('COMPANY_EMAIL'))
				->cc(['amansaini87@rediffmail.com', 'Vikas@re-thinkingthefuture.com'])
				->queue(new PaidUser(auth()->user()));
			return to_route('architect.account.profile.setting.billing')->with([
				'type' => 'success',
				'message' => 'You have successfully subscribed to ' . $subscriptionPlan->plan_name,
			]);
		}
		catch (IncompletePayment $exception) {
			ErrorLogController::logErrorNew('stripe callback IncompletePayment', $exception);
			// dd($exception);
			return redirect()->route('cashier.payment', [
				'id' => $exception->payment->id,
				// 'id' => $exception->payment->payment_method,
				'success_url' => redirect()->route('architect.account.profile.setting.billing')->with([
					'type' => 'success',
					'message' => 'You have successfully subscribed to ' . $subscriptionPlan->plan_name,
				])->getTargetUrl(),
				'cancel_url' => redirect()->route('architect.stripe.checkout', ['subscriptionPlan' => $subscriptionPlan->slug])->with([
					'type' => 'error',
					'message' => 'You have cancelled the payment',
				])->getTargetUrl(),
			]);
		}
		catch(Exception $exp){
			ErrorLogController::logErrorNew('stripe callback', $exp);
			return back()->with([
				'type' => 'error',
				'message' => $exp->getMessage(),
			]);
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
