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
						<a href="{{ route('architect.account.profile.index') }}" class="text-secondary fs-6 fw-medium">Profile</a>
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

	<livewire:architects.account.notification />
</div>
@endsection
