<?php

namespace App\Livewire\Users\Pricing;

use App\Models\SubscriptionPlan;
use Livewire\Component;

class Plan2024 extends Component
{
	public $currency;
	public $planType;
	public bool $isSubscribed = false;
	public $subscriptionPlans;

	public $features;
	public $freePlanAmount;

	public function mount()
	{
		$this->freePlanAmount = [
			'USD' => 350,
			'INR' => 25000,
			'EUR' => 350,		
		];
						
		$this->currency = 'USD';
		$this->planType = 'Essential Monthly';
		$this->isSubscribed = isSubscribed();
		$path = resource_path('menus/pricePlan.json');
		$this->features = json_decode(file_get_contents($path));
		// dd($this->features);
	}

    public function render()
    {
		$this->subscriptionPlans = SubscriptionPlan::where('currency', $this->currency)->get();
		// dd($this->subscriptionPlans);
        return view('livewire.users.pricing.plan2024');
    }

	public function subscribe($slug)
	{
		// dd($slug);
		return to_route('architect.stripe.checkout', ['subscriptionPlan' => $slug]);
	}
}
