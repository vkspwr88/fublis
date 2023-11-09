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
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Account</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Profile</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Analytics</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="text-dark fs-3 fw-semibold m-0">See where your stories are published</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="{{ route('architect.account.profile.alert') }}" class="btn btn-link text-decoration-none text-purple-600 fs-6 fw-semibold">
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

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-12">
			<div class="card rounded-3 shadow border-0">
				<div class="card-header rounded-top-3 bg-white">
					<table class="table m-0 p-0">
						<tr>
							<th class="border-0">
								<div class="input-group">
									<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
									<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search Media Kit" aria-label="Search" />
								</div>
							</th>
						</tr>
					</table>
				</div>
				<div class="card-body">
					<table class="table">
						<tr>
							<th class="text-secondary fs-7">Project Name</th>
							<th class="text-secondary fs-7">Views</th>
							<th class="text-secondary fs-7">Downloads</th>
							<th class="text-secondary fs-7">Track Story</th>
						</tr>
						@forelse ($mediaKits as $mediaKit)
						<tr>
							<td class="py-4">
								<div class="row align-items-center g-1">
									<div class="col-auto">
										<img class="rounded-circle img-square img-32" src="{{ Storage::url($mediaKit->story->cover_image_path) }}" alt="..." />
									</div>
									<div class="col">
										<h6 class="text-dark fs-7 fw-medium m-0 p-0">{{ $mediaKit->story->title }}</h6>
										<p class="text-secondary fs-8 m-0 p-0">{{ showModelName($mediaKit->story_type) }}</p>
									</div>
								</div>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">{{ $mediaKit->view_count }}</span>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">{{ $mediaKit->download_count }}</span>
							</td>
							<td class="py-4">
								<a href="{{ getMediaKitViewUrl( showModelName($mediaKit->story_type), $mediaKit->id ) }}" class="btn btn-primary btn-sm">Track</a>
							</td>
						</tr>
						@empty
						<tr>
							<th colspan="4">
								<h4 class="fs-5 text-center text-purple-800">No Media Kit Added</h4>
							</th>
						</tr>
						@endforelse
						{{-- <tr>
							<td class="py-4">
								<div class="row align-items-center g-1">
									<div class="col-auto">
										<img class="rounded-circle img-32" src="https://via.placeholder.com/32x32" alt="..." />
									</div>
									<div class="col">
										<h6 class="text-dark fs-7 fw-medium m-0 p-0">Casa Brut Hubli</h6>
										<p class="text-secondary fs-8 m-0 p-0">Project, India</p>
									</div>
								</div>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">34</span>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">34</span>
							</td>
							<td class="py-4">
								<a href="#" class="btn btn-primary btn-sm">Track</a>
							</td>
						</tr>
						<tr>
							<td class="py-4">
								<div class="row align-items-center g-1">
									<div class="col-auto">
										<img class="rounded-circle img-32" src="https://via.placeholder.com/32x32" alt="..." />
									</div>
									<div class="col">
										<h6 class="text-dark fs-7 fw-medium m-0 p-0 text-truncate">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates</h6>
										<p class="text-secondary fs-8 m-0 p-0">Press Release</p>
									</div>
								</div>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">34</span>
							</td>
							<td class="py-4">
								<span class="btn btn-outline-success btn-sm">34</span>
							</td>
							<td class="py-4">
								<a href="#" class="btn btn-primary btn-sm">Track</a>
							</td>
						</tr> --}}
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
