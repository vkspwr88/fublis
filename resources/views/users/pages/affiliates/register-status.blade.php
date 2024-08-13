@extends('users.layouts.master')

{!! seo() !!}

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
	<div class="container py-5">
		<div class="mb-3 row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item fublis-breadcrumb-item">
							<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
						</li>
						<li class="breadcrumb-item fublis-breadcrumb-item text-secondary fs-6 fw-medium" aria-current="page">Affiliate</li>
						<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Journalists</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row g-4 justify-content-end align-items-end">
			<div class="col">
				<div class="d-flex justify-content-start">
					<h2 class="m-0 text-dark fs-4 fw-semibold">Affiliate Program</h2>
				</div>
			</div>
		</div>

		<hr class="my-4 border-gray-300">

		@if ($status === ApplicationStatusEnum::PENDING)
			@include('users.includes.affiliates.status.pending')
		@elseif ($status === ApplicationStatusEnum::DECLINED)
			@include('users.includes.affiliates.status.declined')
		@endif
	</div>
	{{-- <div class="row">
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
	</div> --}}
@endsection

