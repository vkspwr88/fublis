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
	public int $allowedTotalUser = 2;
	public $paymentToken;

	public function mount()
	{
		$user = auth()->user();
		dd(request()->user(), $user->subscribed(), isBusinessPlanSubscribed(), isEnterprisePlanSubscribed(), $user->subscribedToProduct('prod_Q4ny3KlIL7WAgX'), $user->subscribedToPrice('price_1PEeMjSF38t8VQrgcCfGfFpm'));
		$this->userCount = CompanyController::getMediaContacts()->count();
		$latestSubscription = $user?->latestSubscription;
		// dd($latestSubscription);
		if (isBusinessPlanSubscribed()) {
			$this->allowedTotalUser = CompanyController::getAllowedArchitects('Business Plan');
			$this->planName = 'Business plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
		}
		elseif (isEnterprisePlanSubscribed()) {
			$this->allowedTotalUser = CompanyController::getAllowedArchitects('Enterprise Plan');
			$this->planName = 'Enterprise plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
		}
		$this->progress = $this->userCount * 100 / $this->allowedTotalUser;
	}

    public function render(Request $request)
    {
		$user = $request->user();
		// dd($user);
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
