@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="mb-3 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Account</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Profile</a>
					</li>
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Analytics</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="m-0 text-dark fs-3 fw-semibold">See where your stories are published</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="{{ route('architect.account.profile.alert') }}" class="text-purple-600 btn btn-link text-decoration-none fs-6 fw-semibold">
						<i class="bi bi-plus"></i> Add Alert
					</a>
				</div>
				<div class="col-auto">
					<a href="{{ route('architect.media-kit.index') }}" class="btn btn-white text-dark fs-6 fw-semibold">
						<i class="bi bi-stack"></i> All Media kits
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<div class="row">
		<div class="col-12">
			@if(isSubscribed())
				<livewire:architects.account.analytic />
			@else
				<div class="border-0 shadow card rounded-3">
					<div class="card-body">
						<div class="py-4 text-center">
							<h4 class="mb-4 text-purple-700 fs-5">
								Upgrade your plan to see the media kits analytics
							</h4>
							<p class="mb-0">
								<a href="{{ route('pricing') }}" class="btn btn-primary">Upgrade your plan</a>
							</p>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection
