@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container">
	<div class="row">
		<div class="col">
			<div class="p-5">
				<input id="card-holder-name" type="text">

				<!-- Stripe Elements Placeholder -->
				<div id="card-element"></div>

				<button id="card-button" data-secret="{{ $intent->client_secret }}">
					Update Payment Method
				</button>
			</div>
		</div>
	</div>
</div>

@endsection


@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
	const stripe = Stripe('{{ env('STRIPE_KEY') }}')
	const elements = stripe.elements()
	const cardElement = elements.create('card')
	cardElement.mount('#card-element')

	const cardHolderName = document.getElementById('card-holder-name')
	const cardButton = document.getElementById('card-button')
	const clientSecret = cardButton.dataset.secret;

	cardButton.addEventListener('click', async (e) => {
		const { setupIntent, error } = await stripe.confirmCardSetup(
			clientSecret, {
				payment_method: {
					card: cardElement,
					billing_details: { name: cardHolderName.value }
				}
			}
		);

		if (error) {
			// Display "error.message" to the user...
			console.log('Error:', error);
		} else {
			// The card has been verified successfully...
			console.log('Verified');
			/* let token = document.createElement('input')
	        token.setAttribute('type', 'hidden')
	        token.setAttribute('name', 'token')
	        token.setAttribute('value', setupIntent.payment_method)
	        form.appendChild(token)
	        form.submit(); */
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
