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
					{{-- <li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('architect.account.profile.index') }}" class="text-secondary fs-6 fw-medium">Profile</a>
					</li> --}}
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Notifications</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="pb-5 row">
		<div class="col">
			<h2 class="p-0 m-0 text-dark fs-3 fw-semibold">Notifications</h2>
		</div>
	</div>

	<div class="pb-4 row">
		<div class="col">
			<h3 class="p-0 m-0 text-dark fs-5 fw-semibold">All Notifications</h3>
		</div>
	</div>

	<livewire:architects.account.notification />
</div>
@endsection
