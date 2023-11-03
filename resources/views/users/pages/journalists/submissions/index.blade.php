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
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Submissions</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.brand-header', ['headerTitle' => 'Submissions for your calls'])

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-lg-4">
			<div class="filter-btn text-end pb-3">
				<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
					<i class="bi bi-filter"></i>
				</button>
			</div>
			<div class="position-relative">
				<div class="filter-container" id="collapsedFilter">
					<livewire:journalists.submissions.filter />
				</div>
			</div>
		</div>
		<div class="col-lg-8">
			<livewire:journalists.submissions.media-kits />
		</div>
	</div>
</div>
@endsection
