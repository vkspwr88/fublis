<div class="py-5 container-fluid">
    <div class="row g-4 {{-- gy-5 --}}">
		<div class="col-md-12">
			<div class="mx-auto text-center">
				<div class="btn-group">
					<input type="radio" class="btn-check" wire:model.live="planType" id="annualRadio" autocomplete="off" value="annual">
					<label class="btn btn-outline-primary" for="annualRadio">Annual billing <span class="px-1 border small rounded-pill">Save 33%</span></label>
					<input type="radio" class="btn-check" wire:model.live="planType" id="quarterlyRadio" autocomplete="off" value="quarterly">
					<label class="btn btn-outline-primary" for="quarterlyRadio">Quarterly billing</label>
				</div>
			</div>
		</div>
		<div class="col-xxl-8 offset-xxl-2 col-xl-10 offset-xl-1 col-lg-12 offset-lg-0">
			<div class="mb-1 row">
				<div class="col-md-12">
					<div class="ms-auto text-end">
						<div class="btn-group">
							<input type="radio" class="btn-check" wire:model.live="currency" id="currencyUsdRadio" autocomplete="off" value="USD">
							<label class="btn btn-outline-primary" for="currencyUsdRadio">USD</label>
							<input type="radio" class="btn-check" wire:model.live="currency" id="currencyInrRadio" autocomplete="off" value="INR">
							<label class="btn btn-outline-primary" for="currencyInrRadio">INR</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center g-4">
				@foreach ($subscriptionPlans as $subscriptionPlan)
					<div class="col-md-6">
						<div class="p-3 border-0 shadow card rounded-3 text-secondary h-100">
							<div class="py-4 bg-transparent card-header">
								<div class="row g-4">
									<div class="col-lg col-md-12">
										@if( Str::contains($subscriptionPlan->plan_name, 'Business Plan Annual') )
											<span class="text-purple-700 bg-purple-100 badge rounded-pill position-absolute" style="top: 1rem;">Popular</span>
										@endif
										<h2 class="m-0 mb-1 fs-4 fw-bold text-dark">{{ $subscriptionPlan->plan_name }}</h2>
										<p class="m-0 fs-7">
											@if ( Str::contains($subscriptionPlan->plan_name, 'Business Plan') )
												@if( Str::contains($subscriptionPlan->plan_name, 'Business Plan Annual') )
													Our most popular plan fits all.
												@else
													Starting plan that fits all.
												@endif
											@elseif ( Str::contains($subscriptionPlan->plan_name, 'Enterprise Plan') )
												@if( Str::contains($subscriptionPlan->plan_name, 'Enterprise Plan Annual') )
													Advanced support and reporting.
												@else
													Starting plan that fits all.
												@endif
											@endif
										</p>
										<p class="m-0">Billed {{ ucfirst($planType->value) }}.</p>
									</div>
									<div class="col-lg-auto col-md-12">
										<h3 class="m-0 fs-1 fw-bold text-dark text-start text-lg-end"><span class="align-top fs-3">
											{{ $subscriptionPlan->symbol }}</span>{{ number_format($subscriptionPlan->price_per_month, 0) }}<span class="fs-7 fw-medium text-secondary">per month</span>
										</h3>
									</div>
								</div>
							</div>
							<div class="py-4 card-body">
								<div class="row g-4">
									@if (Str::contains($subscriptionPlan->plan_name, 'Business Plan'))
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
									@elseif (Str::contains($subscriptionPlan->plan_name, 'Enterprise Plan'))
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
							<div class="py-4 bg-transparent card-footer">
								<div class="d-grid">
									@if($isSubscribed)
										@if(auth()->user()->subscribed($subscriptionPlan->slug))
											<button type="button" class="btn btn-success text-capitalize fw-medium">Subscribed</button>
										@else
											<button type="button" class="btn btn-danger text-capitalize fw-medium">not subscribed</button>
										@endif
									@else
										<button type="button" class="btn btn-primary text-capitalize fw-medium" wire:click="subscribe('{{ $subscriptionPlan->slug }}')">
											Upgrade Now <x-users.spinners.white-btn wire:target="subscribe('{{ $subscriptionPlan->slug }}')" />
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
