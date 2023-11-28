@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<h4 class="text-center text-black fs-5 fw-bold m-0 py-2">Looking for fresh stories? It's easy & free.</h4>
	<p class="text-center text-black fs-6 fw-normal m-0 py-2">You're just 2 mins away from downloading fresh stories</p>

	<livewire:journalist-signup-wizard />
</div>
@push('scripts')
<script src="{{ asset('js/otp.js') }}"></script>
{{-- <script>
	let inputAllowed = false;
	$(document).on('keydown', '.otp-inputs', function (e) {
		if (48 > e.which || e.which > 57){
			if (e.key.length === 1){
				inputAllowed = false;
				e.preventDefault();
			}
		}
		else{
			inputAllowed = true;
		}
	});
	$(document).on('keyup', '.otp-inputs', function (e) {
		if(e.which == 8){
			$(this).prev('.otp-inputs').focus();
		}
		else if(inputAllowed){
			$(this).next('.otp-inputs').focus();
		}
	});
</script> --}}
@endpush
@endsection
