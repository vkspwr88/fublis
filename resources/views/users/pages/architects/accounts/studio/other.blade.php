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
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Brands</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">{{ $brand->category->name }}</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">{{ $brand->name }}</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="text-dark fs-3 fw-semibold m-0">{{ $brand->name }}</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="javascript:;" class="btn btn-link text-decoration-none text-purple-600 fs-6 fw-semibold">
						<i class="bi bi-plus"></i> Create New Call
					</a>
				</div>
				<div class="col-auto">
					<a href="javascript:;" class="btn btn-white text-dark fs-6 fw-semibold">
						<i class="bi bi-stack"></i> All Media kits
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	@include('users.includes.common.profile-company', [
		'viewAs' => 'other',
	])

</div>
@endsection
