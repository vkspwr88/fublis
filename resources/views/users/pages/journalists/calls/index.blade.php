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
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Your Calls</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="text-dark fs-3 fw-semibold m-0">Your call for stories</h2>
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
					<a href="{{ route('journalist.media-kit.index') }}" class="btn btn-white text-dark fs-6 fw-semibold">
						<i class="bi bi-stack"></i> All Media kits
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
	<div class="row g-4">
		@forelse ($calls as $call)
			<div class="col-12">
				<div class="card rounded-3 shadow">
					<div class="card-body">
						<a href="{{ route('journalist.call.view', ['call' => $call->id]) }}" class="stretched-link"></a>
						<div class="row g-2 align-items-center">
							<div class="col-12">
								<div class="row align-items-center">
									<div class="col-auto">
										<h4 class="text-dark fs-5 fw-semibold m-0 py-1">{{ $call->title }}</h4>
										<p class="text-secondary fs-6 m-0 py-1">Deadline: {{ $call->submission_end_date }}</p>
									</div>
									<div class="col">
										<div class="d-flex justify-content-end">
											<p class="m-0 py-2" style="z-index: 2;">
												<a href="{{ route('journalist.call.edit', ['call' => $call->id]) }}" class="btn btn-primary btn-sm">Edit Call</a>
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="row justify-content-center align-items-end">
									<div class="col-auto">
										<div class="row">
											<div class="col-auto">
												<img class="rounded-circle img-square img-45" src="{{ $call->publication->profileImage ? Storage::url($call->publication->profileImage->image_path) : "https://via.placeholder.com/45x45" }}" alt=".." />
											</div>
											<div class="col">
												<p class="text-secondary fw-semibold m-0 p-0">{{ $call->publication->name }}</p>
												<p class="text-secondary m-0 p-0"><span class="small">{{ $call->journalist->user->name }}</span></p>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="row gx-1 gy-3 justify-content-end align-items-center">
											@foreach ($call->tags as $tag)
												<div class="col-auto">
													<span class="badge rounded-pill bg-purple-50 text-purple-700 fw-medium">{{ $tag->name }}</span>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@empty
			<div class="col-12">
				<div class="card rounded-3 shadow">
					<div class="card-body">
						<h4 class="card-title fs-4 fw-semibold text-purple-800 text-center">No stories added by you</h4>
					</div>
				</div>
			</div>
		@endforelse
	</div>
</div>
@endsection
