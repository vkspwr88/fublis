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
						$subscriptionAmountRaw = $subscriptionPrice->price_per_month * $subscriptionPrice->quantity;
						$subscriptionAmount = number_format($subscriptionPrice->price_per_month * $subscriptionPrice->quantity, 2);
						$subscriptionTime = $subscriptionPrice->quantity == 3 ? 'every 3 months' : 'per year';
					@endphp
					<div class="card-header bg-primary text-white">
						You will be charged ${{ $subscriptionAmount }} for {{ str()->headline($subscriptionPrice->slug) }}
					</div>
					<div class="card-body">
						<form id="paymentForm" method="POST" action="{{ route('architect.stripe.callback', ['subscriptionPrice' => $subscriptionPrice->slug]) }}">
							@csrf
							<input type="hidden" name="plan" id="plan" value="{{ $subscriptionPrice->slug }}">
							{{-- <div class="row mb-3">
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
										Subscribe to {{ $subscriptionPrice->subscriptionPlan->plan_name }}
									</p>
									<h4 class="fw-bold text-dark fs-4">
										${{ $subscriptionAmount }}
										<small class="text-muted fw-medium fs-7">{{ $subscriptionTime }}</small>
									</h4>
									<p class="fs-6">
										Billed {{ $subscriptionTime }}, according to
										<strong class="fs-5">${{ number_format($subscriptionPrice->price_per_month, 2) }}</strong>
										per month
									</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col">
									<div class="form-group">
										{{-- <label for="card-element">Card Details</label> --}}
										{{-- <div id="card-element"></div> --}}
										<div id="payment-element"></div>
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
<script>
	const stripe = Stripe('{{ env('STRIPE_KEY') }}');
	const clientSecret = '{{ $intent->client_secret }}';
	const appearance = { /* appearance */ };
	const options = {
		layout: {
    		type: 'tabs',
		},
		// defaultValues: {
		// 	billingDetails: {
		// 		name: '{{ auth()->user()->name }}',
		// 		email: '{{ auth()->user()->email }}'
		// 	}
		// },
		paymentMethodOrder: ['card'],
		business: {
			name: '{{ env('COMPANY_NAME') }}'
		}
	};
	const elements = stripe.elements({ clientSecret, appearance });
	/* const elements = stripe.elements({
		mode: 'subscription',
		currency: 'usd',
		amount: {{ $subscriptionAmountRaw }}
	}); */
	const paymentElement = elements.create('payment', options);
	paymentElement.mount('#payment-element');

	const cardButton = document.getElementById('card-button');
	const form = document.getElementById('paymentForm');
	// const clientSecret = cardButton.dataset.secret;
	let purchaseSubmit = false;

	cardButton.addEventListener('click', async (e) => {
		e.preventDefault();
		cardButton.disabled = true;
		purchaseSubmit = true;
		const { setupIntent, error } = await stripe.confirmSetup({
			elements,
			// clientSecret,
			// confirmParams: {
			// 	return_url: '{{ route('architect.stripe.callback', ['subscriptionPrice' => $subscriptionPrice->slug]) }}'
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
			/* let message = '';
			for (const key in error) {
				if (Object.hasOwnProperty.call(error, key)) {
					const element = error[key];
					console.log(key, element);
				}
			} */
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

    /* const form = document.getElementById('payment-form')

	form.addEventListener('submit', async (e) => {
	    e.preventDefault()
	    cardBtn.disabled = true
	    const { setupIntent, error } = await stripe.confirmCardSetup(
	        cardBtn.dataset.secret, {
	            payment_method: {
	                card: cardElement,
	                billing_details: {
	                    name: cardHolderName.value
	                }
	            }
	        }
	    )

	    if(error) {
	        cardBtn.disable = false
	    } else {
	        let token = document.createElement('input')
	        token.setAttribute('type', 'hidden')
	        token.setAttribute('name', 'token')
	        token.setAttribute('value', setupIntent.payment_method)
	        form.appendChild(token)
	        form.submit();
	    }
	}) */

</script>
@endpush
