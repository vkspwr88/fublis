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
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Draft Media Kits</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4">
		<div class="col-sm-6">
			<h2 class="text-dark fs-3 fw-semibold m-0">Draft Media Kits</h2>
		</div>
		<div class="col-sm-6 text-end">
			<a href="{{ route('architect.add-story.index') }}" class="btn btn-link text-decoration-none text-purple-600 fs-6 fw-semibold"><i class="bi bi-plus"></i> Add Story</a>
			<a href="{{ route('architect.pitch-story.index') }}" class="btn btn-white text-dark fs-6 fw-semibold"><i class="bi bi-arrow-up-right"></i> Start Pitching</a>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<livewire:architects.add-stories.draft />
</div>
@endsection
