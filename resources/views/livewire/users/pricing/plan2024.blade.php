<div class="py-5 container" id="pricingContainer">
    <div class="row g-4">
		<div class="col-md-12">
			<div class="ms-auto text-start">
				<div class="btn-group">
					<input type="radio" class="btn-check" wire:model.live="currency" id="currencyUsdRadio" autocomplete="off" value="USD">
					<label class="btn btn-outline-primary" for="currencyUsdRadio">USD</label>
					<input type="radio" class="btn-check" wire:model.live="currency" id="currencyEuroRadio" autocomplete="off" value="EUR">
					<label class="btn btn-outline-primary" for="currencyEuroRadio">EUR</label>
					<input type="radio" class="btn-check" wire:model.live="currency" id="currencyInrRadio" autocomplete="off" value="INR">
					<label class="btn btn-outline-primary" for="currencyInrRadio">INR</label>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row g-0">
				<div class="col">
					@php
						$essentialPlan = $subscriptionPlans->firstWhere('plan_name', $planType);
						$businessPlan = $subscriptionPlans->firstWhere('plan_name', 'Business Annual');
					@endphp
						
					<div id="pricingCard" class="card-group pb-4">
						<div class="card rounded-4 border-0" data-title="FREE PLAN">
							<div class="card-header bg-transparent">
								<div class="row g-3">
									<div class="col-12">
										<h3 class="m-0 fs-1 text-muted text-decoration-line-through">
											{{ $essentialPlan->symbol }} {{ $freePlanAmount[$currency] }}
										</h3>
									</div>
									<div class="col-12">
										<h3 class="m-0 fs-1 text-dark">{{ $essentialPlan->symbol }} NIL <span class="fs-7 fw-medium text-secondary">per month</span></h3>
									</div>
									<div class="col-12">
										<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-semibold p-2 fs-6">Start pitching with free account</span>
									</div>
									<div class="col-12">
										<h4 class="m-0 fs-5 fw-bold">FREE Starter Plan</h4>
										<h4 class="m-0 text-muted fw-bold" style="font-size: 1.1rem;">No Billing. No Credit Card.</h4>
									</div>
									<div class="col-12">
										<p class="m-0">Try out basic features, upload media kits, pitch to journalists, submit to call for submissions, participate in awards, with just few clicks.</p>
									</div>
								</div>
							</div>
							<div class="card-body">
								<h5 class="card-title fs-6 fw-semibold mb-4" id="freeBenefitsHeading">
									<a class="text-dark" data-bs-toggle="collapse" href="#freeBenefits" role="button" aria-expanded="true" aria-controls="freeBenefits">
										<span>BENEFITS</span>
										<span class="text-secomdary"><i class="bi bi-chevron-down"></i></span>
									</a>
								</h5>
								@isset($features->free)
									<div class="collapse show" id="freeBenefits" aria-labelledby="freeBenefitsHeading">
										<div class="row g-2">
											@foreach ($features->free as $feature => $available)
												<x-users.pricing.feature-column :$feature :$available />									
											@endforeach
										</div>
									</div>									
								@endisset
							</div>
							<div class="py-4 card-footer bg-transparent">
								<div class="d-grid">
									<a href="{{ route('architect.signup') }}" class="btn btn-primary text-capitalize fw-medium">get started</a>
								</div>
							</div>
						</div>
						<div class="card rounded-4 border-0" data-title="ESSENTIAL PLAN">
							<div class="card-header bg-purple-600 rounded-top-4 text-white">
								<div class="row g-3">
									<div class="col-12">
										<h3 class="m-0 fs-1 text-gray-300 text-decoration-line-through">
											{{ $essentialPlan->symbol }} {{ $essentialPlan->actual_price }}
										</h3>
									</div>
									<div class="col-12">
										<h3 class="m-0 fs-1">{{ $essentialPlan->symbol }} {{ $essentialPlan->price_per_month }} <span class="fs-7 fw-medium">per month</span></h3>
									</div>
									<div class="col-12">
										<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-semibold p-2 fs-6">
											{{ $essentialPlan->discount_percentage }}% OFF | Offer ends this month
										</span>
									</div>
									<div class="col-12">
										<h4 class="m-0 fs-5 fw-bold">Essential Plan</h4>
										<h4 class="m-0 text-gray-300 fw-bold" style="font-size: 1.1rem;">Billed {{ $planType == 'Essential Monthly' ? 'Monthly' : 'Annually' }}</h4>
									</div>
									<div class="col-12">
										<p class="m-0">Access most of the features. Good for small to mid-size teams.</p>
									</div>
									<div class="col-12">
										<div class="mx-auto text-center">
											<div class="btn-group" id="planTypeGroup">
												<input type="radio" class="btn-check" wire:model.live="planType" id="monthlyRadio" autocomplete="off" value="Essential Monthly">
												<label class="btn" for="monthlyRadio">Monthly</label>
												<input type="radio" class="btn-check" wire:model.live="planType" id="annualRadio" autocomplete="off" value="Essential Annual">
												<label class="btn" for="annualRadio">Annual <span class="px-2 small rounded-pill">+ 42% OFF</span></label>												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body border-start border-end">
								<h5 class="card-title fs-6 fw-semibold mb-4">									
									<a class="text-dark" data-bs-toggle="collapse" href="#essentialBenefits" role="button" aria-expanded="true" aria-controls="essentialBenefits">
										<span>BENEFITS</span>
										<span class="text-secomdary"><i class="bi bi-chevron-down"></i></span>
									</a>
								</h5>
								@isset($features->essential)
									<div class="collapse show" id="essentialBenefits" aria-labelledby="essentialBenefitsHeading">
										<div class="row g-2">
											@foreach ($features->essential as $feature => $available)
												<x-users.pricing.feature-column :$feature :$available />									
											@endforeach
										</div>
									</div>
								@endisset
							</div>
							<div class="py-4 card-footer bg-transparent">
								<div class="d-grid">
									@if($isSubscribed)
										@if(auth()->user()->subscribed($essentialPlan->slug))
											<button type="button" class="btn btn-success text-capitalize fw-medium">Subscribed</button>
										@else
											<button type="button" class="btn btn-danger text-capitalize fw-medium">not subscribed</button>
										@endif
									@else
										<button type="button" class="btn btn-primary text-capitalize fw-medium" wire:click="subscribe('{{ $essentialPlan->slug }}')">
											Upgrade Now <x-users.spinners.white-btn wire:target="subscribe('{{ $essentialPlan->slug }}')" />
										</button>
									@endif
								</div>
							</div>
						</div>
						<div class="card rounded-4 border-0" data-title="BUSINESS PLAN">
							<div class="card-header bg-transparent">
								<div class="row g-3">
									<div class="col-12">
										<h3 class="m-0 fs-1 text-muted text-decoration-line-through">
											{{ $businessPlan->symbol }} {{ $businessPlan->actual_price }}
										</h3>
									</div>
									<div class="col-12">
										<h3 class="m-0 fs-1 text-dark">{{ $businessPlan->symbol }} {{ $businessPlan->price_per_month }} <span class="fs-7 fw-medium text-secondary">per month</span></h3>
									</div>
									<div class="col-12">
										<span class="badge rounded-pill bg-purple-100 text-purple-700 fw-semibold p-2 fs-6">
											{{ $businessPlan->discount_percentage }}% OFF | Offer ends this month
										</span>
									</div>
									<div class="col-12">
										<h4 class="m-0 fs-5 fw-bold">Business Plan</h4>
										<h4 class="m-0 text-muted fw-bold" style="font-size: 1.1rem;">Billed Annually</h4>
									</div>
									<div class="col-12">
										<p class="m-0">Access all of the features, with unlimited pitching & download requests, account manager and access to additional 100K bloggers + magazine.</p>
									</div>
								</div>
							</div>
							<div class="card-body">
								<h5 class="card-title fs-6 fw-semibold mb-4">
									<a class="text-dark" data-bs-toggle="collapse" href="#businessBenefits" role="button" aria-expanded="true" aria-controls="businessBenefits">
										<span>BENEFITS</span>
										<span class="text-secomdary"><i class="bi bi-chevron-down"></i></span>
									</a>
								</h5>
								@isset($features->business)
									<div class="collapse show" id="businessBenefits" aria-labelledby="businessBenefitsHeading">
										<div class="row g-2">
											@foreach ($features->business as $feature => $available)
												<x-users.pricing.feature-column :$feature :$available />
											@endforeach
										</div>
									</div>
								@endisset
							</div>
							<div class="py-4 card-footer bg-transparent">
								<div class="d-grid">
									@if($isSubscribed)
										@if(auth()->user()->subscribed($businessPlan->slug))
											<button type="button" class="btn btn-success text-capitalize fw-medium">Subscribed</button>
										@else
											<button type="button" class="btn btn-danger text-capitalize fw-medium">not subscribed</button>
										@endif
									@else
										<button type="button" class="btn btn-primary text-capitalize fw-medium" wire:click="subscribe('{{ $businessPlan->slug }}')">
											Upgrade Now <x-users.spinners.white-btn wire:target="subscribe('{{ $businessPlan->slug }}')" />
										</button>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
