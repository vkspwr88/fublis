@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.setting-breadcrumb')

	@include('users.includes.architect.setting-header')

	<hr class="border-gray-300 my-4">

	@include('users.includes.architect.setting-nav', ['setting' => 'Billing'])

	<div class="py-4">
		<div class="row">
			<div class="col">
				<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Payment Method</h4>
				<p class="text-secondary fs-6 m-0 p-0">
					<small>Update your billing details.</small>
				</p>
			</div>
		</div>
		<hr>
		<form id="paymentMethodForm" method="POST" action="{{ route('architect.account.profile.setting.billing.payment-method.update') }}">
			@csrf
			<div class="row">
				<div class="col">
					<div class="form-group">
						<div id="payment-element"></div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col">
					<button id="card-button" type="submit" class="btn btn-primary fw-medium" data-secret="{{ $clientSecret }}">
						Save Details
					</button>
					<a href="{{ route('architect.account.profile.setting.billing') }}" class="btn btn-white text-dark">
						Cancel
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
	const stripe = Stripe('{{ env('STRIPE_KEY') }}');
	const clientSecret = '{{ $clientSecret }}';
	const appearance = { };
	const options = {
		layout: {
			type: 'tabs',
		},
		paymentMethodOrder: ['card'],
		business: {
			name: '{{ env('COMPANY_NAME') }}'
		}
	};
	const elements = stripe.elements({ clientSecret, appearance });
	const paymentElement = elements.create('payment', options);
	paymentElement.mount('#payment-element');

	const cardButton = document.getElementById('card-button');
	const form = document.getElementById('paymentMethodForm');

	let formSubmit = false;

	cardButton.addEventListener('click', async (e) => {
		e.preventDefault();
		cardButton.disabled = true;
		formSubmit = true;
		const { setupIntent, error } = await stripe.confirmSetup({
			elements,
			redirect: 'if_required',
		});

		if (error) {
			// Display "error.message" to the user...
			console.log('Error:', error);
			cardButton.disabled = false;
			formSubmit = false;

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
</script>
@endpush
