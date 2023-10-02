@extends('users.layouts.master')

@section('body')
<div class="container py-5">
	<div class="row g-0">
		<div class="col-md-6 offset-md-3 border border-5">
			<div class="text-center p-5">
				@if($verify)
				<h3 class="mb-4">Welcome!</h3>
				<p>
					Thank you for verifying your email address for our Newsletter Subscription.
				</p>
				@else
				<h3 class="mb-4">Welcome again!</h3>
				<p>
					You had already verified your email address for our Newsletter Subscription.
				</p>
				@endif
			</div>
        </div>
    </div>
</div>
@endsection
