<?php

namespace App\Livewire\Architects\Accounts\Settings;

use App\Http\Controllers\Users\CompanyController;
use Illuminate\Http\Request;
use Livewire\Component;

class Billing extends Component
{
	protected $invoices;
	protected $paymentMethod;
	protected $intent;
	public int $userCount = 0;
	public $dataSecret;
	// public $latestSubscription;
	public bool $isPaymentMethodOpen = false;
	public int $progress;
	public string $planName = 'Free plan';
	public int $pricePerMonth = 0;
	public int $allowedTotalUser = 1;
	public $paymentToken;

	public function mount()
	{
		$user = auth()->user();
		$this->userCount = CompanyController::getMediaContacts()->count();
		$latestSubscription = $user?->latestSubscription;
		if (isBusinessPlanSubscribed()) {
			$this->allowedTotalUser = 20;
			$this->planName = 'Business plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
		}
		else if (isEnterprisePlanSubscribed()) {
			$this->allowedTotalUser = 3;
			$this->planName = 'Enterprise plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
		}
		$this->progress = $this->userCount * 100 / $this->allowedTotalUser;
	}

    public function render(Request $request)
    {
		$user = $request->user();
        return view('livewire.architects.accounts.settings.billing', [
			'invoices' => $user->invoices(),
			'paymentMethod' => $user->defaultPaymentMethod(),
		]);
    }

	public function openPaymentMethodForm(Request $request)
	{
		/* $user = $request->user();
		$this->intent = $user->createSetupIntent();
		$this->dataSecret = $this->intent->client_secret;
		$this->isPaymentMethodOpen = true; */
		return to_route('architect.account.profile.setting.billing.payment-method.show');
	}

	public function closePaymentMethodForm()
	{
		$this->isPaymentMethodOpen = false;
	}

	public function updatePaymentMethod(Request $request)
	{
		$user = $request->user();
		$user->updateDefaultPaymentMethod($this->paymentToken);
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Payment method has been updated successfully.'
		]);
	}
}
