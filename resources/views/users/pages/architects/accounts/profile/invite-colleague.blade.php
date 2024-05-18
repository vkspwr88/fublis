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
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Invite Colleague</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="m-0 text-dark fs-3 fw-semibold">Invite Colleague</h2>
			</div>
		</div>
		<div class="col-auto">
			<div class="row justify-content-end align-items-end gx-0 gy-3">
				<div class="col-auto">
					<a href="{{ route('architect.account.profile.setting.team') }}" class="btn btn-white text-dark fs-6 fw-semibold">
						<i class="bi bi-person-circle"></i> Team Members
					</a>
				</div>
			</div>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<livewire:common.invite-colleague.form sender="architect" />
</div>
@endsection
