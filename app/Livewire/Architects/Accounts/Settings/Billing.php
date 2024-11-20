<?php

namespace App\Livewire\Architects\Accounts\Settings;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use App\Http\Controllers\Users\Architects\DownloadController;
use App\Http\Controllers\Users\Architects\SubscriptionController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\MediaKitController;
use Illuminate\Http\Request;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
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
	public string $planCurrency = '$';
	public string $planName = 'Free plan';
	public int $pricePerMonth = 0;
	public int $allowedTotalUser = 2;
	public $paymentToken;

	public int $allowedTotalPressReleases;
	public int $allowedTotalProjects;
	public int $allowedTotalArticles;
	public int $createdTotalPressReleases;
	public int $createdTotalProjects;
	public int $createdTotalArticles;
	public int $pressReleaseProgress;
	public int $projectProgress;
	public int $articleProgress;

	public int $allowedTotalPitches;
	public int $createdTotalPitches;
	public int $pitchesProgress;

	public int $allowedTotalRequests;
	public int $createdTotalRequests;
	public int $requestsProgress;

	public function mount()
	{
		$user = auth()->user();
		$this->userCount = CompanyController::getMediaContacts()->count();
		$latestSubscription = $user?->latestSubscription;
		// $this->allowedTotalPressReleases = MediaKitController::getAllowedMediaKits('press-release');
		// $this->allowedTotalProjects = MediaKitController::getAllowedMediaKits('project');
		// $this->allowedTotalArticles = MediaKitController::getAllowedMediaKits('article');
		$this->allowedTotalPitches = SubscriptionController::getAllowedPitches();
		// $this->allowedTotalRequests = DownloadController::getAllowedDownloadRequest();
		if (isBusinessPlanSubscribed()) {
			$this->allowedTotalUser = CompanyController::getAllowedArchitects('Business Plan');
			$this->planName = 'Business plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
			$this->planCurrency = $latestSubscription->subscriptionPrice->symbol;

			// $this->allowedTotalPressReleases = 1000;
			// $this->allowedTotalProjects = 1000;
			// $this->allowedTotalArticles = 1000;
			$this->allowedTotalPitches = 10000;
			// $this->allowedTotalRequests = 10000;
		}
		elseif (isEnterprisePlanSubscribed()) {
			$this->allowedTotalUser = CompanyController::getAllowedArchitects('Enterprise Plan');
			$this->planName = 'Enterprise plan';
			$this->pricePerMonth = $latestSubscription->subscriptionPrice->price_per_month;
			$this->planCurrency = $latestSubscription->subscriptionPrice->symbol;
		}
		$this->progress = $this->allowedTotalUser > 0 ? $this->userCount * 100 / $this->allowedTotalUser : 0;

		// $this->createdTotalPressReleases = MediaKitController::getTotalCreatedMediaKits('press-release');
		// $this->createdTotalProjects = MediaKitController::getTotalCreatedMediaKits('project');
		// $this->createdTotalArticles = MediaKitController::getTotalCreatedMediaKits('article');
		// $this->pressReleaseProgress = $this->createdTotalPressReleases * 100 / $this->allowedTotalPressReleases;
		// $this->projectProgress = $this->createdTotalProjects * 100 / $this->allowedTotalProjects;
		// $this->articleProgress = $this->createdTotalArticles * 100 / $this->allowedTotalArticles;

		$this->createdTotalPitches = SubscriptionController::getTotalPitches();
		$this->pitchesProgress = $this->allowedTotalPitches > 0 ? $this->createdTotalPitches * 100 / $this->allowedTotalPitches : 0;

		// $this->createdTotalRequests = DownloadController::getTotalRequest()->count();
		$totalRequests = DownloadController::getTotalRequest();
		// $this->allowedTotalRequests = $totalRequests->count();
		$this->allowedTotalRequests = DownloadController::getAllowedDownloadRequest();
		$this->createdTotalRequests = $totalRequests->where('request_status', RequestStatusEnum::APPROVED)->count();
		// $this->requestsProgress = $this->allowedTotalRequests > 0 ? $this->createdTotalRequests * 100 / $this->allowedTotalRequests : 0;
		$this->requestsProgress = $this->allowedTotalRequests > 0 ? $this->createdTotalRequests * 100 / $this->allowedTotalRequests : 0;

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
