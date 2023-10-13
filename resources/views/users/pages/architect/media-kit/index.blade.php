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

	<div class="row">
		<div class="col-md-7">
			<h2 class="text-dark fs-3 fw-semibold m-0">All Media Kits</h2>
		</div>
		<div class="col-md-5 text-end">
			<a href="{{ route('architect.add-story.index') }}" class="btn btn-link text-decoration-none text-purple-600 fs-6 fw-semibold"><i class="bi bi-plus"></i> Add Story</a>
			<a href="{{ route('architect.pitch-story.index') }}" class="btn btn-white text-dark fs-6 fw-semibold"><i class="bi bi-arrow-up-right"></i> Start Pitching</a>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-sm-5 col-md-4">
			<div class="position-sticky" style="top: 7rem;">
				<div class="card border-0 rounded-3 bg-white shadow">
					<div class="card-body">
						<form wire:submit="search">
							<div class="row g-0 mb-4">
								<div class="col">
									<div class="d-grid">
										<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="published-outlined" autocomplete="off" checked>
										<label class="btn btn-outline-primary rounded-0 fw-semibold" for="published-outlined">Published</label>
									</div>
								</div>
								<div class="col">
									<div class="d-grid">
										<input type="radio" class="btn-check btn-filter-check" name="options-outlined" id="drafts-outlined" autocomplete="off">
										<label class="btn btn-outline-primary rounded-0 fw-semibold" for="drafts-outlined">Drafts</label>
									</div>
								</div>
							</div>
							<div class="input-group mb-4">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" />
							</div>
							<x-users.filter.header text="Media Kit Type" />
							<x-users.filter.checkbox-list type="media-kit-type" :list="$mediaKitTypes" model="selectedMediaKitType" />
							<hr class="divider">
							<x-users.filter.header text="Categories" />
							<x-users.filter.checkbox-list type="category" :list="$categories" model="selectedCategories" />
							<hr class="divider">
							<div class="d-grid">
								<button type="submit" class="btn btn-white text-capitalize">search</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-7 col-md-8">
			<div class="row g-4">
				<div class="col-12">
					<div class="card border-0 rounded-3 bg-white shadow">
						<div class="card-body">
							<a href="{{ route('architect.media-kit.article.view', ['id' => 'id']) }}" class="stretched-link"></a>
							<div class="row">
								<div class="col-md-4">
									<img src="https://via.placeholder.com/300x300" class="img-fluid" alt="...">
								</div>
								<div class="col-md-8">
									<div class="row justify-content-center pb-2">
										<p class="text-secondary fs-6 fw-semibold col m-0">Article</p>
										<p class="text-end text-secondary fs-6 fw-semibold col m-0">Architecure</p>
									</div>
									<h5 class="card-title text-dark fs-5 fw-semibold m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates...</h5>
									<div class="row align-items-center py-2">
										<div class="col">
											<p class="text-dark fs-6 fw-bold m-0">
												<img class="img-fluid rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="..." />
												Studio Name Harris
											</p>
										</div>
									</div>
									<p class="card-text text-dark fs-6 m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</p>
									<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
										<p class="fs-6 fw-bold col m-0">
											<a href="{{ route('architect.media-kit.article.edit', ['id' => 'id']) }}" class="text-purple-600">
												Edit Story <i class="bi bi-arrow-up-right small"></i>
											</a>
										</p>
										<p class="text-end fs-5 fw-bold col m-0">
											<a href="#" class="text-purple-600">
												<i class="bi bi-share-fill"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="card border-0 rounded-3 bg-white shadow">
						<div class="card-body">
							<a href="{{ route('architect.media-kit.project.view', ['id' => 'id']) }}" class="stretched-link"></a>
							<div class="row">
								<div class="col-md-4">
									<img src="https://via.placeholder.com/300x300" class="img-fluid" alt="...">
								</div>
								<div class="col-md-8">
									<div class="row justify-content-center pb-2">
										<p class="text-secondary fs-6 fw-semibold col m-0">Project</p>
										<p class="text-end text-secondary fs-6 fw-semibold col m-0">Architecure</p>
									</div>
									<h5 class="card-title text-dark fs-5 fw-semibold m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates...</h5>
									<div class="row align-items-center py-2">
										<div class="col">
											<p class="text-dark fs-6 fw-bold m-0">
												<img class="img-fluid rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="..." />
												Studio Name Harris
											</p>
										</div>
									</div>
									<p class="card-text text-dark fs-6 m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</p>
									<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
										<p class="fs-6 fw-bold col m-0">
											<a href="{{ route('architect.media-kit.project.edit', ['id' => 'id']) }}" class="text-purple-600">
												Edit Story <i class="bi bi-arrow-up-right small"></i>
											</a>
										</p>
										<p class="text-end fs-5 fw-bold col m-0">
											<a href="#" class="text-purple-600">
												<i class="bi bi-share-fill"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="card border-0 rounded-3 bg-white shadow">
						<div class="card-body">
							<a href="{{ route('architect.media-kit.press-release.view', ['id' => 'id']) }}" class="stretched-link"></a>
							<div class="row">
								<div class="col-md-4">
									<img src="https://via.placeholder.com/300x300" class="img-fluid" alt="...">
								</div>
								<div class="col-md-8">
									<div class="row justify-content-center pb-2">
										<p class="text-secondary fs-6 fw-semibold col m-0">Press Release</p>
										<p class="text-end text-secondary fs-6 fw-semibold col m-0">Architecure</p>
									</div>
									<h5 class="card-title text-dark fs-5 fw-semibold m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates...</h5>
									<div class="row align-items-center py-2">
										<div class="col">
											<p class="text-dark fs-6 fw-bold m-0">
												<img class="img-fluid rounded-circle me-2" src="https://via.placeholder.com/30x30" alt="..." />
												Studio Name Harris
											</p>
										</div>
									</div>
									<p class="card-text text-dark fs-6 m-0 py-2">The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</p>
									<div class="row justify-content-center pt-2 position-relative" style="z-index: 2;">
										<p class="fs-6 fw-bold col m-0">
											<a href="{{ route('architect.media-kit.press-release.edit', ['id' => 'id']) }}" class="text-purple-600">
												Edit Story <i class="bi bi-arrow-up-right small"></i>
											</a>
										</p>
										<p class="text-end fs-5 fw-bold col m-0">
											<a href="#" class="text-purple-600">
												<i class="bi bi-share-fill"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
