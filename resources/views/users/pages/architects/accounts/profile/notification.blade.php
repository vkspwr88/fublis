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
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Notifications</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row pb-5">
		<div class="col">
			<h2 class="text-dark fs-3 fw-semibold m-0 p-0">Notifications</h2>
		</div>
	</div>

	<div class="row pb-4">
		<div class="col">
			<h3 class="text-dark fs-5 fw-semibold m-0 p-0">All Notifications</h3>
		</div>
	</div>

	<div class="row g-4 align-items-center">
		<div class="col-auto">
			<div class="row g-4 align-items-center">
				<div class="col-auto">
					<div class="bg-gray-400 text-dark rounded-circle fs-5 p-2 fw-light"><i class="bi bi-person-plus"></i></div>
				</div>
				<div class="col">
					<h5 class="text-black fs-6 fw-semibold m-0 p-0">Project Requests</h5>
					<p class="text-secondary fs-6 m-0 p-0">
						<small>Manage your team members here</small>
					</p>
				</div>
			</div>
		</div>
		<div class="col text-end">
			<button type="button" class="btn btn-white text-dark fw-semibold">Check All Requests</button>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">Today</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Week</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Month</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
</div>
@endsection
