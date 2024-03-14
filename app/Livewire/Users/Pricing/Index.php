<?php

namespace App\Livewire\Users\Pricing;

use App\Enums\Users\Architects\SubscriptionPlanTypeEnum;
use App\Http\Controllers\Users\SubscriptionPlanController;
use Livewire\Component;

class Index extends Component
{
	public $subscriptionPlans;
	// public $subscriptionPrices;
	public $planType;
	public bool $isSubscribed = false;

	public function mount()
	{
		$this->planType = SubscriptionPlanTypeEnum::ANNUAL;
		$this->subscriptionPlans = SubscriptionPlanController::getAll();
		$this->isSubscribed = isSubscribed();
	}

    public function render()
    {
		// dd($this->planType, $this->subscriptionPlans);
        return view('livewire.users.pricing.index');
    }

	public function subscribe($slug)
	{
		// dd($slug);
		return to_route('architect.stripe.checkout', ['subscriptionPrice' => $slug]);
	}
}
