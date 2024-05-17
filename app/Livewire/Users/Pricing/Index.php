<?php

namespace App\Livewire\Users\Pricing;

use App\Enums\Users\Architects\SubscriptionPlanTypeEnum;
use App\Http\Controllers\Payments\RazorpayController;
use App\Http\Controllers\Users\SubscriptionPlanController;
use Livewire\Component;

class Index extends Component
{
	public $subscriptionPlans;
	// public $subscriptionPrices;
	public $planType;
	public $currency;
	public bool $isSubscribed = false;
	public $businessPlanFeatures;
	public $enterprisePlanFeatures;

	public function mount()
	{
		$this->planType = SubscriptionPlanTypeEnum::ANNUAL;
		$this->currency = 'USD';
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
		$this->subscriptionPlans = SubscriptionPlanController::getRecordsByPlanTypeAndCurrency($this->planType, $this->currency);
		// dd($this->subscriptionPlans);
        return view('livewire.users.pricing.index');
    }

	public function subscribe($slug)
	{
		// dd($slug);
		return to_route('architect.stripe.checkout', ['subscriptionPlan' => $slug]);
	}
}
