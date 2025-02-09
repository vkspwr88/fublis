@extends('users.layouts.master')

{!! seo() !!}

@push('styles')
	<style>
		#body{
			background: #fff;
		}
	</style>
@endpush

@section('body')
<div class="container py-5">
	<div class="mb-3 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Unsubscribe</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="pb-5 row">
		<div class="col-md-6">
			<h2 class="p-0 mb-4 text-dark fs-1 fw-semibold">Email Preferences</h2>
			<p class="text-secondary fs-6 mb-5">Manage Your Email Preferences. Stay in Control - Choose the Notifications That Matter Most to You.</p>

			<livewire:architects.email-preferences.index />
		</div>
		<div class="col-md-6 align-self-center">
			<img src="{{ asset('images/unsubscribe.png') }}" class="img-fluid" alt="">
		</div>
	</div>
</div>
@endsection
