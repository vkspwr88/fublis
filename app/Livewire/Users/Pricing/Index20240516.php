<?php

namespace App\Livewire\Users\Pricing;

use App\Enums\Users\Architects\SubscriptionPlanTypeEnum;
use App\Http\Controllers\Payments\RazorpayController;
use App\Http\Controllers\Users\SubscriptionPlanController;
use Livewire\Component;

class Index20240516 extends Component
{
	public $subscriptionPlans;
	// public $subscriptionPrices;
	public $planType;
	public bool $isSubscribed = false;
	public $businessPlanFeatures;
	public $enterprisePlanFeatures;

	public function mount()
	{
		$this->planType = SubscriptionPlanTypeEnum::ANNUAL;
		$this->isSubscribed = isSubscribed();
		$this->businessPlanFeatures = [
			'Unlimited project media kits',
			'Unlimited article media kits',
			'Unlimited press release media kits',
			'Unlimited pitching to journalists',
			'Ready to publish media kit template',
			'Real-time chat with journalists',
			'Media kit performance analytics',
			'Access to premium publications',
			'Guaranteed Publication',
			'Up to 5 Individual Users',
		];
		$this->enterprisePlanFeatures = [
			'Weekly performance reports automated',
			'Dedicated account manager',
			'Monthly performance reports automated',
			'Quarterly PR strategy plan advisory',
			'Priority email & chat support',
			'Access to Additional Blogger networks',
			'Automated follow-up reminders',
			'PR Training with educational resources',
			'Up to 20 Individual Users',
			'+ many more...',
		];
	}

    public function render()
    {
		// dd($this->planType, $this->subscriptionPlans);
		$this->subscriptionPlans = SubscriptionPlanController::getRecordsByPlanType($this->planType);
		// dd($this->subscriptionPlans);
        return view('livewire.users.pricing.index');
    }

	public function subscribe($slug)
	{
		// dd($slug);
		// return to_route('architect.stripe.checkout', ['subscriptionPlan' => $slug]);
		$subscriptionId = 'sub_O7z0kBScypLL8i';
		$planId = 'plan_O7z0FxJLQbZNeR';
		$selectedPlan = $this->subscriptionPlans->where('slug', $slug)->first();
		// dd($slug, $this->subscriptionPlans, $selectedPlan);
		$amount = (int)(1 * 100);
		$currency = 'USD';

		$notes = array(
			'subscription_id' => $subscriptionId,
			'paln_id' => $planId,
			'slug' => $slug,
			'description' => $selectedPlan->plan_name,
			'user' => auth()->id(),
			'user_name' => strtoupper(auth()->user()->name),
			'user_email' => auth()->user()->email,
			/* 'user' => auth()->id(),
			'prices'=> $this->prices,
			'address' => $this->addresses[$this->defaultAddress],
			'products' => $cartProducts, */
		);
		$details = array(
			'user_id' => auth()->id(),
			'amount' => $amount,
			'currency' => $currency,
			'notes' => json_encode($notes),
		);
		$razorpayController = new RazorpayController;
		$razorpay = $razorpayController->create($details);

		// create an razorpay order
		$details = array(
			'receipt' => $razorpay->id,
			'amount' => $amount,
			'currency' => $currency,
			'notes'=> array(
				'user' => auth()->id(),
			),
		);
		$razorpayOrder = $razorpayController->createOrder($details);

		// update the record in razorpay table
		session()->put('order_id', $razorpayOrder->id);
		$razorpay->order_id = $razorpayOrder->id;
		$razorpay->save();

		// redirect to payment gateway
		return to_route('architect.razorpay.checkout', [
			'razorpay' => $razorpay->id,
		]);
	}
}
