<div class="container py-5">
    <div class="row g-4">
		<div class="col-md-12">
			<div class="mx-auto text-center">
				<div class="btn-group" role="group">
					<input type="radio" class="btn-check" wire:model.live="planType" id="quaterlyRadio" autocomplete="off" value="quaterly">
					<label class="btn btn-outline-primary" for="quaterlyRadio">Quaterly billing</label>
					<input type="radio" class="btn-check" wire:model.live="planType" id="annualRadio" autocomplete="off" value="annual">
					<label class="btn btn-outline-primary" for="annualRadio">Annual billing <span class="border small rounded-pill px-1">Save 33%</span></label>
				</div>
			</div>
		</div>
		<div class="col-xl-10 offset-xl-1 col-lg-12">
			<div class="row justify-content-center g-4">
				@php
					$businessPlanFeatures = [
						'Unlimited project media kits',
						'Unlimited article media kits',
						'Unlimited press release media kits',
						'Unlimited pitching to journalists',
						'Ready to publish media kit template',
						'Real-time chat with journalists',
						'Media kit performance analytics',
						'Access to premium publications',
						'Guaranteed Publication',
						'Up to 3 Individual Users',
					];
					$enterprisePlanFeatures = [
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
				@endphp
				@foreach ($subscriptionPlans as $subscriptionPlan)
					@php
						$subscriptionPrice = $subscriptionPlan->subscriptionPrices->where('plan_type', $planType)->first();
					@endphp
					<div class="col-md-6">
						<div class="border-0 shadow card rounded-3 text-secondary h-100">
							<div class="card-header py-4 bg-transparent">
								<div class="row g-4">
									<div class="col-lg col-md-12">
										@if($subscriptionPlan->plan_name == 'Business Plan')
											<span class="text-purple-700 bg-purple-100 badge rounded-pill position-absolute" style="top: 5px;">Popular</span>
										@endif
										<h2 class="m-0 mb-1 fs-4 fw-bold text-dark">{{ $subscriptionPlan->plan_name }} {{ ucfirst($planType->value) }}</h2>
										<p class="m-0">Our most popular brand fits all.</p>
										<p class="m-0">Billed {{ ucfirst($planType->value) }}.</p>
									</div>
									<div class="col-lg-auto col-md-12">
										<h3 class="m-0 fs-1 fw-bold text-dark text-start text-lg-end"><span class="align-top fs-3">
											$</span>{{ $subscriptionPrice->price_per_month }}<span class="fs-7 fw-medium text-secondary">per month</span>
										</h3>
									</div>
								</div>
							</div>
							<div class="card-body py-4">
								<div class="row g-4">
									@if ($subscriptionPlan->plan_name == 'Business Plan')
										<div class="col-md-12">
											<h5 class="fs-6 fw-bold text-uppercase text-dark">features</h5>
											<p class="m-0 fs-6">Includes all the things to upscale your PR results...</p>
										</div>
										<div class="col-md-12">
											<div class="row g-3">
												@foreach ($businessPlanFeatures as $feature)
													<x-users.pricing.feature-column :feature="$feature" />
												@endforeach
											</div>
										</div>
									@elseif ($subscriptionPlan->plan_name == 'Enterprise Plan')
										<div class="col-md-12">
											<h5 class="fs-6 fw-bold text-uppercase text-dark">features</h5>
											<p class="m-0 fs-6">Everything in our business plan plus....</p>
										</div>
										<div class="col-md-12">
											<div class="row g-3">
												@foreach ($enterprisePlanFeatures as $feature)
													<x-users.pricing.feature-column :feature="$feature" />
												@endforeach
											</div>
										</div>
									@endif
								</div>
							</div>
							<div class="card-footer py-4 bg-transparent">
								<div class="d-grid">
									@if($isSubscribed)
										@if(auth()->user()->subscribed($subscriptionPrice->slug))
											<button type="button" class="btn btn-success text-capitalize fw-medium">Subscribed</button>
										@else
											<button type="button" class="btn btn-danger text-capitalize fw-medium">not subscribed</button>
										@endif
									@else
										<button type="button" class="btn btn-primary text-capitalize fw-medium" wire:click="subscribe('{{ $subscriptionPrice->slug }}')">
											Upgrade Now <x-users.spinners.white-btn wire:target="subscribe('{{ $subscriptionPrice->slug }}')" />
										</button>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
    </div>
</div>
