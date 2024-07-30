@extends('users.layouts.affiliates.register')

@push('styles')
	<style>
		.application-status{
			position: relative;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 70vh;
		}
		.center-div{
			max-width: 550px;
			text-align: center;
			padding: 40px;
		}
	</style>
@endpush

@section('body')
	@php
		use \App\Enums\Affiliates\ApplicationStatusEnum;
	@endphp
	<div class="row">
		<div class="col-md-12">
			<div class="application-status">
				<div class="border center-div border-3">
					@if ($status === ApplicationStatusEnum::PENDING)
						<h4 class="mb-4 text-purple-700 fs-4 fw-semibold">Thank You for Applying to Become a Fublis Affiliate!</h4>
						<p class="text-secondary">We're excited to have you join our Affiliate Program and help promote Fublis memberships. Your application is under review. You will receive an email notification with the outcome of your application in the coming 5 days.</p>
					@elseif ($status === ApplicationStatusEnum::DECLINED)

					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

