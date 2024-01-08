@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="row mb-3">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('journalist.call.index') }}" class="text-secondary fs-6 fw-medium">Your Calls</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">{{ $call->title }}</li>
				</ol>
			</nav>
		</div>
	</div>
	<div>
		<div class="row g-4 justify-content-end align-items-end">
			<div class="col">
				<div class="d-flex justify-content-start">
					<h2 class="text-dark fs-3 fw-semibold m-0">View Your Call</h2>
				</div>
			</div>
			<div class="col-auto">
				<div class="row justify-content-end align-items-end gx-0 gy-3">
					<div class="col-auto">
						<a href="{{ route('journalist.call.create') }}" class="btn btn-link text-decoration-none text-purple-600 fw-semibold">
							<i class="bi bi-plus"></i> Create New Call
						</a>
					</div>
					<div class="col-auto">
						<a href="{{ route('journalist.call.index') }}" class="btn btn-white text-dark fw-semibold">
							<i class="bi bi-stack"></i> Your Calls
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr class="border-gray-300 my-4">
		<div class="row justify-content-center">
			<div class="col-md-9">
				@include('livewire.journalists.calls.view')
				<hr class="border-gray-300 my-3">
				<div class="row g-4">
					<div class="col-md-8 offset-md-4">
						<div class="text-start">
							<a class="btn btn-primary fw-semibold" href="{{ route('journalist.call.edit', ['call' => $call->slug]) }}">Edit Call</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
