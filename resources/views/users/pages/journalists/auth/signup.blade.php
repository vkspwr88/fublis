@extends('users.layouts.auth')

{!! seo() !!}

@section('body')
<div class="container">
	<h4 class="text-center text-black fs-5 fw-bold m-0 py-2">Looking for fresh stories? It's easy & free.</h4>
	<p class="text-center text-black fs-6 fw-normal m-0 py-2">You're just 2 mins away from downloading fresh stories</p>

	<livewire:journalist-signup-wizard show-step="{{ $step }}" :initial-state="$initialState" />
</div>
@push('scripts')
<script src="{{ asset('js/otp.js') }}"></script>
@endpush
@endsection
