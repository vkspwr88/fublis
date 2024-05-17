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
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">All Media Kits</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4">
		<div class="col-sm-6">
			<h2 class="m-0 text-dark fs-3 fw-semibold">All Media Kits</h2>
		</div>
		<div class="col-sm-6 text-end">
			<a href="{{ route('architect.add-story.index') }}" class="text-purple-600 btn btn-link text-decoration-none fs-6 fw-semibold"><i class="bi bi-plus"></i> Add Story</a>
			<a href="{{ route('architect.pitch-story.index') }}" class="btn btn-white text-dark fs-6 fw-semibold"><i class="bi bi-arrow-up-right"></i> Start Pitching</a>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<livewire:architects.media-kits.index />
</div>
@endsection

@include('users.includes.architect.pitch-story-modals-script')
