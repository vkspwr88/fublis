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
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Your Calls</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="m-0 text-dark fs-3 fw-semibold">Your call for stories</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="{{ route('journalist.call.create') }}" class="text-purple-600 btn btn-link text-decoration-none fw-semibold">
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
	<hr class="my-4 border-gray-300">
	<div class="row g-4">
		@forelse ($calls as $call)
			@if ($call)
				<div class="col-12">
					<div class="shadow card rounded-3">
						<div class="card-body">
							<a href="{{ route('journalist.call.view', ['call' => $call->slug]) }}" class="stretched-link" aria-label="View Call"></a>
							<div class="row g-2 align-items-center">
								<div class="col-12">
									<div class="row align-items-center">
										<div class="col-auto">
											<h4 class="py-1 m-0 text-dark fs-5 fw-semibold">{{ $call->title }}</h4>
											<p class="py-1 m-0 text-secondary fs-6">Deadline: {{ $call->submission_end_date }}</p>
										</div>
										<div class="col">
											<div class="d-flex justify-content-end">
												<p class="py-2 m-0" style="z-index: 2;">
													<a href="{{ route('journalist.call.edit', ['call' => $call->slug]) }}" class="btn btn-primary btn-sm">Edit Call</a>
												</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="row justify-content-center align-items-end">
										<div class="col-auto">
											<div class="row g-3">
												<div class="col-auto">
													@php
														$profileImg = App\Http\Controllers\Users\AvatarController::getProfileAvatar($call->publication, 'publication');
													@endphp
													<img class="rounded-circle img-square img-45" src="{{ $profileImg }}" alt=".." />
												</div>
												<div class="col">
													<p class="p-0 m-0 fw-semibold">
														@if($call->publication)
															<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $call->publication->slug]) }}" class="text-secondary" style="z-index: 2;">{{ $call->publication->name }}</a>
														@endif
													</p>
													<p class="p-0 m-0">
														<span class="small">
															@if($call->journalist)
																<a href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $call->journalist->slug]) }}" class="text-secondary" style="z-index: 2;">{{ $call->journalist->user->name }}</a>
															@endif
														</span>
													</p>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row gx-1 gy-3 justify-content-end align-items-center">
												@foreach ($call->tags as $tag)
													<div class="col-auto">
														<span class="text-purple-700 badge rounded-pill bg-purple-50 fw-medium">{{ $tag->name }}</span>
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
			@endif
		@empty
			<div class="col-12">
				<div class="shadow card rounded-3">
					<div class="card-body">
						<h4 class="text-center text-purple-800 card-title fs-4 fw-semibold">No stories added by you</h4>
					</div>
				</div>
			</div>
		@endforelse
	</div>
</div>
@endsection
