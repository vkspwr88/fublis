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
						<a href="{{ route('journalist.account.profile.index') }}" class="text-secondary fs-6 fw-medium">Profile</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Analytics</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Check Your Notifications'])

	<div class="row pt-5 pb-4">
		<div class="col">
			<h3 class="text-dark fs-5 fw-semibold m-0 p-0">Notifications</h3>
		</div>
	</div>

	<livewire:journalists.account.notification />
</div>
@endsection
