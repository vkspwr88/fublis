@extends('users.layouts.master')

{!! seo() !!}

@push('styles')
	<style>
		.InputElement{
			padding: .375rem .75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			appearance: none;
			border-radius: .375rem;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
	</style>
@endpush

@section('body')
<div class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					@php
						$subscriptionAmountRaw = $subscriptionPlan->price_per_month * $subscriptionPlan->quantity;
						$stripeAmount = $subscriptionAmountRaw * 100;
						$subscriptionAmount = number_format($subscriptionPlan->price_per_month * $subscriptionPlan->quantity, 2);
						$subscriptionTime = $subscriptionPlan->quantity == 3 ? 'every 3 months' : 'per year';
					@endphp
					<div class="text-white card-header bg-primary">
						You will be charged ${{ $subscriptionAmount }} for {{ str()->headline($subscriptionPlan->slug) }}
					</div>
					<div class="card-body">
						<form id="paymentForm" method="POST" action="{{ route('architect.stripe.callback', ['subscriptionPlan' => $subscriptionPlan->slug]) }}">
							@csrf
							<input type="hidden" name="plan" id="plan" value="{{ $subscriptionPlan->slug }}">
							{{-- <div class="mb-3 row">
								<div class="col">
									<div class="form-group">
										<label for="">Name</label>
										<input type="text" name="name" id="card-holder-name" class="form-control" value="" placeholder="Name on the card">
									</div>
								</div>
							</div> --}}
							<div class="row">
								<div class="col">
									<p class="text-muted fs-6">
										Subscribe to {{ $subscriptionPlan->plan_name }}
									</p>
									<h4 class="fw-bold text-dark fs-4">
										${{ $subscriptionAmount }}
										<small class="text-muted fw-medium fs-7">{{ $subscriptionTime }}</small>
									</h4>
									<p class="fs-6">
										Billed {{ $subscriptionTime }}, according to
										<strong class="fs-5">${{ number_format($subscriptionPlan->price_per_month, 2) }}</strong>
										per month
									</p>
								</div>
							</div>
							<hr>
							<div class="row g-4">
								@if ($paymentMethod)
									<div class="col-md-6">
										<div class="mb-3">
											<div class="form-check">
												<input class="form-check-input filter-checkbox" type="radio" name="payment_type" id="oldPaymentType" autocomplete="off" value="old" checked>
												<label class="form-check-label" for="oldPaymentType">Default Payment Method</label>
											</div>
										</div>
										<div class="mb-3">
											<div class="row g-3">
												<div class="col-auto">
													<span class="py-3 btn btn-white text-dark">
														<img src="{{ asset('images/icons/payments/' . $paymentMethod->card->display_brand . '.png') }}" alt="{{ $paymentMethod->card->display_brand }}" class="img-fluid" />
													</span>
												</div>
												<div class="col text-secondary">
													<p class="m-0 fs-6 fw-medium text-dark">
														{{ ucfirst($paymentMethod->card->display_brand) }} ending in {{ $paymentMethod->card->last4 }}
													</p>
													<p class="mb-2 fs-6 fw-normal">Expiry {{ sprintf('%02d', $paymentMethod->card->exp_month) }}/{{ $paymentMethod->card->exp_year }}</p>
													@if($paymentMethod->billing_details->email)
														<p class="m-0 fs-6 fw-normal"><i class="bi bi-envelope"></i> {{ $paymentMethod->billing_details->email }}</p>
													@endif
												</div>
											</div>
										</div>
									</div>
								@endif
								<div class="col-md-6">
									<div class="mb-3">
										<div class="form-check">
											<input class="form-check-input filter-checkbox" type="radio" name="payment_type" id="newPaymentType" autocomplete="off" value="new" {{ $paymentMethod ? '' : 'checked' }}>
											<label class="form-check-label" for="newPaymentType">New Payment Method</label>
										</div>
									</div>
									<div class="mb-3">
										<div id="payment-element"></div>
									</div>
									<div class="mb-3">
  										<div id="address-element">
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col">
									<button id="card-button" class="btn btn-primary fw-medium" data-secret="{{ $intent->client_secret }}">
										Purchase
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
{{-- <script>
	const stripe = Stripe('{{ env('STRIPE_KEY') }}');
	const clientSecret = '{{ $intent->client_secret }}';
	const appearance = { /* appearance */ };
	const options = {
		layout: {
    		type: 'tabs',
		},
		paymentMethodOrder: ['card'],
		business: {
			name: '{{ env('COMPANY_NAME') }}'
		},
		// defaultValues: {
		// 	billingDetails: {
		// 		name: '{{ auth()->user()->name }}',
		// 	}
		// }
	};
	const elements = stripe.elements({ clientSecret, appearance });
	// const elements = stripe.elements({
	// 	mode: 'subscription',
	// 	currency: 'usd',
	// 	amount: {{ $stripeAmount }}
	// });
	// const addressElement = elements.create('address', {
	// 	mode: 'billing',
	// 	defaultValues: {
	// 		name: '{{ auth()->user()->name }}',
	// 	}
	// });
	const addressElement = elements.create('address', {
		mode: 'billing',
		autocomplete: {
			mode: 'disabled'
		}
	});
	const paymentElement = elements.create('payment', options);
	addressElement.mount('#address-element');
	paymentElement.mount('#payment-element');

	const cardButton = document.getElementById('card-button');
	const form = document.getElementById('paymentForm');
	// const clientSecret = cardButton.dataset.secret;
	let purchaseSubmit = false;

	cardButton.addEventListener('click', async (e) => {
		e.preventDefault();
		cardButton.disabled = true;
		purchaseSubmit = true;
		if($('#oldPaymentType').prop('checked')){
	        form.submit();
			return false;
		}
		const { setupIntent, error } = await stripe.confirmSetup({
			elements,
			// clientSecret,
			// confirmParams: {
			// 	return_url: '{{ route('architect.stripe.callback', ['subscriptionPlan' => $subscriptionPlan->slug]) }}'
			// },
			redirect: 'if_required',
		});

		if (error) {
			// Display "error.message" to the user...
			console.log('Error:', error);
			cardButton.disabled = false;
			purchaseSubmit = false;

			showAlert({
				'type' : 'error',
				'message' : error.message
			});
			// let message = '';
			// for (const key in error) {
			// 	if (Object.hasOwnProperty.call(error, key)) {
			// 		const element = error[key];
			// 		console.log(key, element);
			// 	}
			// }
		} else {
			// The card has been verified successfully...
			console.log('Verified');
			let token = document.createElement('input')
	        token.setAttribute('type', 'hidden')
	        token.setAttribute('name', 'token')
	        token.setAttribute('value', setupIntent.payment_method)
	        form.appendChild(token)
	        form.submit();
		}
	});
</script> --}}

<script>
	const stripe = Stripe('{{ env('STRIPE_KEY') }}');
	const clientSecret = '{{ $intent->client_secret }}';
	const options = {
		layout: {
    		type: 'tabs',
		},
		paymentMethodOrder: ['card'],
		business: {
			name: '{{ env('COMPANY_NAME') }}'
		},
	};
	const elements = stripe.elements({
		mode: 'subscription',
		currency: 'usd',
		amount: {{ $stripeAmount }},
		paymentMethodTypes: ['card'],
		setupFutureUsage: 'off_session',
	});

	const addressElement = elements.create('address', {
		mode: 'billing',
		autocomplete: {
			mode: 'disabled'
		}
	});
	const paymentElement = elements.create('payment', options);
	addressElement.mount('#address-element');
	paymentElement.mount('#payment-element');

	const cardButton = document.getElementById('card-button');
	const form = document.getElementById('paymentForm');
	let purchaseSubmit = false;

	cardButton.addEventListener('click', async (e) => {
		e.preventDefault();
		cardButton.disabled = true;
		purchaseSubmit = true;
		if($('#oldPaymentType').prop('checked')){
	        form.submit();
			return false;
		}
		const {error: submitError} = await elements.submit();
		console.log('submitError', submitError);

		const { error } = await stripe.confirmPayment({
			elements,
			clientSecret,
			setupFutureUsage: 'off_session',
			confirmParams: {
				return_url: '{{ route('architect.stripe.callback', ['subscriptionPlan' => $subscriptionPlan->slug]) }}'
			},
			redirect: 'if_required',
		});

		if (error) {
			// Display "error.message" to the user...
			console.log('Error:', error);
			cardButton.disabled = false;
			purchaseSubmit = false;

			showAlert({
				'type' : 'error',
				'message' : error.message
			});
		} else {
			// The card has been verified successfully...
			console.log('Verified');
			let token = document.createElement('input')
	        token.setAttribute('type', 'hidden')
	        token.setAttribute('name', 'token')
	        token.setAttribute('value', setupIntent.payment_method)
	        form.appendChild(token)
	        form.submit();
		}
	});
</script>
@endpush
