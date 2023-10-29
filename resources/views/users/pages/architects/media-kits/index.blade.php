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
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">All Media Kits</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4">
		<div class="col-sm-6">
			<h2 class="text-dark fs-3 fw-semibold m-0">All Media Kits</h2>
		</div>
		<div class="col-sm-6 text-end">
			<a href="{{ route('architect.add-story.index') }}" class="btn btn-link text-decoration-none text-purple-600 fs-6 fw-semibold"><i class="bi bi-plus"></i> Add Story</a>
			<a href="{{ route('architect.pitch-story.index') }}" class="btn btn-white text-dark fs-6 fw-semibold"><i class="bi bi-arrow-up-right"></i> Start Pitching</a>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-lg-4">
			<div class="filter-btn text-end pb-3">
				<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
					<i class="bi bi-filter"></i>
				</button>
			</div>
			<div class="position-relative">
				<div class="filter-container p-0 rounded-3" id="collapsedFilter">
					<div class="card border-0 rounded-3 bg-white shadow">
						<div class="card-body">
							<livewire:architects.media-kits.filter />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<livewire:architects.media-kits.stories />
		</div>
	</div>
</div>
@endsection
