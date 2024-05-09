@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="py-5">
	<div class="container">
	</div>
</div>
@endsection

@push('scripts')
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
		var options = {
			"key": '{{ env('RAZORPAY_KEY_ID') }}',
			"amount": {{ $razorpay->amount }},
			"currency": '{{ $razorpay->currency }}',
			"name": '{{ env('COMPANY_NAME') }}',
			"description": '{{ $notes->description }}',
			"image": '{{ url(env('COMPANY_ICON')) }}',
			"order_id": '{{ $razorpay->order_id }}',
			"callback_url": '{{ route('architect.razorpay.callback', ['razorpay' => $razorpay->id]) }}',
			"prefill": {
				"name": '{{ $notes->user_name }}',
				"email": '{{ $notes->user_email }}',
			},
			"notes": {
				"address": '{{ env('COMPANY_ADDRESS') }}'
			},
			"subscription_id" : "{{ $notes->subscription_id }}",
			"recurring" : true,
			"modal": {
				"escape": false,
				"handleback": false,
				"confirm_close": true,
				"ondismiss": function(){
					window.location = '{{ route('pricing') }}';
				}
			}
		};
		var rzp1 = new Razorpay(options);
		/* rzp1.on('payment.failed', function (response){
			alert(response.error.code);
			alert(response.error.description);
			alert(response.error.source);
			alert(response.error.step);
			alert(response.error.reason);
			alert(response.error.metadata.order_id);
			alert(response.error.metadata.payment_id);
		}); */
		rzp1.open();
	</script>
@endpush
