<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ErrorLogController;
use App\Mail\Admin\PaidUser;
use App\Models\StripeWebhook;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
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
									// ->newSubscription('default', $subscriptionPlan->price_id)
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
			/* Mail::to(env('COMPANY_EMAIL'))
				->cc(['amansaini87@rediffmail.com', 'Vikas@re-thinkingthefuture.com'])
				->queue(new PaidUser(auth()->user())); */
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

	public function handlingWebhook(Request $request)
	{
		info('handlingWebhook on ' . Carbon::now());
		StripeWebhook::create([
			'webhook_request' => $request->all(),
		]);
		// info('event ' . $request->type);
		switch ($request->type) {
			case 'invoice.payment_succeeded':
				// $paymentIntent = $request->data->object; // contains a \Stripe\PaymentIntent
				// handlePaymentIntentSucceeded($paymentIntent);
				echo "<pre>";
				echo $request->data['object']['subscription'];
				echo "</pre>";
				dd($request->data['object']['subscription'], $request->data['object']['lines']['data']/* ['period']['start'], $request->data['object']['lines']['data']['period']['end'], date('Y-m-d', $request->data['object']['lines']['data']['period']['start']), date('Y-m-d', $request->data['object']['lines']['data']['period']['end']) */);
				$subscriptionID = $request->data->subscription;
				$this->handlingPaymentSuccess($subscriptionID);
				break;
			default:
				info('Received unknown event type ' . $request->type);
		}
		/* if($request->type === 'invoice.payment_succeeded'){
			$subscriptionID = $request->data->subscription;
			info('subscription ' . $subscriptionID);
			// If subscription is incompleted, make it active
		} */
		// local.INFO: handlingWebhook {"id":"evt_1PIq7NSF38t8VQrgYUo6V0eM","object":"event","api_version":"2023-10-16","created":1716288028,"data":{"object":{"id":"in_1PIq77SF38t8VQrg8KFLIkw4","object":"invoice","account_country":"IN","account_name":"Fublis Network","account_tax_ids":null,"amount_due":29880000,"amount_paid":29880000,"amount_remaining":0,"amount_shipping":0,"application":null,"application_fee_amount":null,"attempt_count":1,"attempted":true,"auto_advance":false,"automatic_tax":{"enabled":false,"liability":null,"status":null},"billing_reason":"subscription_create","charge":"ch_3PIq78SF38t8VQrg0IUR7cSo","collection_method":"charge_automatically","created":1716288013,"currency":"inr","custom_fields":null,"customer":"cus_Q7e8RKEguIWhw0","customer_address":null,"customer_email":"amansaini87@rediffmail.com","customer_name":"Aman Saini","customer_phone":null,"customer_shipping":null,"customer_tax_exempt":"none","customer_tax_ids":[],"default_payment_method":null,"default_source":null,"default_tax_rates":[],"description":null,"discount":null,"discounts":[],"due_date":null,"effective_at":1716288013,"ending_balance":0,"footer":null,"from_invoice":null,"hosted_invoice_url":"https://invoice.stripe.com/i/acct_1PEcuGSF38t8VQrg/test_YWNjdF8xUEVjdUdTRjM4dDhWUXJnLF9ROThONnkwa2ZoTFpMYWtZTDJENzFHOXpteUtsSWNWLDEwNjgyODgyOQ02006A72p7WW?s=ap","invoice_pdf":"https://pay.stripe.com/invoice/acct_1PEcuGSF38t8VQrg/test_YWNjdF8xUEVjdUdTRjM4dDhWUXJnLF9ROThONnkwa2ZoTFpMYWtZTDJENzFHOXpteUtsSWNWLDEwNjgyODgyOQ02006A72p7WW/pdf?s=ap","issuer":{"type":"self"},"last_finalization_error":null,"latest_revision":null,"lines":{"object":"list","data":[{"id":"il_1PIq77SF38t8VQrgcd62EfkV","object":"line_item","amount":29880000,"amount_excluding_tax":29880000,"currency":"inr","description":"1 × Business Plan Annual (at ₹298,800.00 / year)","discount_amounts":[],"discountable":true,"discounts":[],"invoice":"in_1PIq77SF38t8VQrg8KFLIkw4","livemode":false,"metadata":{"plan":"Fublis Business Plan Annual"},"period":{"end":1747824013,"start":1716288013},"plan":{"id":"price_1PEeMjSF38t8VQrgcCfGfFpm","object":"plan","active":true,"aggregate_usage":null,"amount":29880000,"amount_decimal":"29880000","billing_scheme":"per_unit","created":1715289541,"currency":"inr","interval":"year","interval_count":1,"livemode":false,"metadata":[],"meter":null,"nickname":null,"product":"prod_Q4ny3KlIL7WAgX","tiers_mode":null,"transform_usage":null,"trial_period_days":null,"usage_type":"licensed"},"price":{"id":"price_1PEeMjSF38t8VQrgcCfGfFpm","object":"price","active":true,"billing_scheme":"per_unit","created":1715289541,"currency":"inr","custom_unit_amount":null,"livemode":false,"lookup_key":null,"metadata":[],"nickname":null,"product":"prod_Q4ny3KlIL7WAgX","recurring":{"aggregate_usage":null,"interval":"year","interval_count":1,"meter":null,"trial_period_days":null,"usage_type":"licensed"},"tax_behavior":"unspecified","tiers_mode":null,"transform_quantity":null,"type":"recurring","unit_amount":29880000,"unit_amount_decimal":"29880000"},"proration":false,"proration_details":{"credited_items":null},"quantity":1,"subscription":"sub_1PIq77SF38t8VQrgSYlqTdmt","subscription_item":"si_Q98Noej1261cWA","tax_amounts":[],"tax_rates":[],"type":"subscription","unit_amount_excluding_tax":"29880000"}],"has_more":false,"total_count":1,"url":"/v1/invoices/in_1PIq77SF38t8VQrg8KFLIkw4/lines"},"livemode":false,"metadata":[],"next_payment_attempt":null,"number":"FCB5EF35-0006","on_behalf_of":null,"paid":true,"paid_out_of_band":false,"payment_intent":"pi_3PIq78SF38t8VQrg0P2BSjlp","payment_settings":{"default_mandate":null,"payment_method_options":{"acss_debit":null,"bancontact":null,"card":{"request_three_d_secure":"automatic"},"customer_balance":null,"konbini":null,"sepa_debit":null,"us_bank_account":null},"payment_method_types":null},"period_end":1716288013,"period_start":1716288013,"post_payment_credit_notes_amount":0,"pre_payment_credit_notes_amount":0,"quote":null,"receipt_number":null,"rendering":null,"shipping_cost":null,"shipping_details":null,"starting_balance":0,"statement_descriptor":null,"status":"paid","status_transitions":{"finalized_at":1716288013,"marked_uncollectible_at":null,"paid_at":1716288028,"voided_at":null},"subscription":"sub_1PIq77SF38t8VQrgSYlqTdmt","subscription_details":{"metadata":{"plan":"Fublis Business Plan Annual"}},"subtotal":29880000,"subtotal_excluding_tax":29880000,"tax":null,"test_clock":null,"total":29880000,"total_discount_amounts":[],"total_excluding_tax":29880000,"total_tax_amounts":[],"transfer_data":null,"webhooks_delivered_at":1716288013,"rendering_options":null}},"livemode":false,"pending_webhooks":1,"request":{"id":null,"idempotency_key":"pi_3PIq78SF38t8VQrg0P2BSjlp-payatt_3PIq78SF38t8VQrg04D8A3SK"},"type":"invoice.payment_succeeded"}
		// php artisan cashier:webhook --url "http://127.0.0.1:8000/stripe/webhook"
		// php artisan cashier:webhook --url "https://app.fublis.com/stripe/webhook"
	}

	public function handlingPaymentSuccess(string $subscriptionID)
	{
		$subscription = Subscription::where([
			'stripe_id' => $subscriptionID,
		])->update([
			'stripe_status' => 'active',
			'ends_at' => Carbon::now()->addYear(),
		]);
	}

	public static function notifyAdmin($subscription)
	{
		if($subscription->stripe_status == 'active'){
			Mail::to(env('COMPANY_EMAIL'))
				->cc(['amansaini87@rediffmail.com', 'Vikas@re-thinkingthefuture.com'])
				->queue(new PaidUser($subscription->user));
		}
	}
}
