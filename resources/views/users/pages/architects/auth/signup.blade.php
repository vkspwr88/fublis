@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<h4 class="text-center text-black fs-5 fw-bold m-0 py-2">Get your stories published. It's fast & easy.</h4>
	<p class="text-center text-black fs-6 fw-normal m-0 py-2">You’re just 2 mins away from pitching stories to journalists.</p>

	<livewire:architect-signup-wizard />
</div>
@push('scripts')
<script src="{{ asset('js/otp.js') }}"></script>
@endpush
@endsection
