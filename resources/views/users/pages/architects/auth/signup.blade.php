@extends('users.layouts.auth')

{!! seo() !!}

{{-- @push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush --}}

@section('body')
<div class="container">
	<h4 class="text-center text-black fs-5 fw-bold m-0 py-2">Get your stories published. It's fast & easy.</h4>
	<p class="text-center text-black fs-6 fw-normal m-0 py-2">You’re just 2 mins away from pitching stories to journalists.</p>

	<livewire:architect-signup-wizard />
</div>
@push('scripts')
<script src="{{ asset('js/otp.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
	$('.select2-dropdown').select2({
		width: 'resolve',
	});
</script> --}}
@endpush
@endsection
