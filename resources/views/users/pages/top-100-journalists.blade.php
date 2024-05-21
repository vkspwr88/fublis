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
					<li class="breadcrumb-item fublis-breadcrumb-item text-secondary fs-6 fw-medium" aria-current="page">Lists</li>
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Journalists</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row g-4 justify-content-end align-items-end">
		<div class="col">
			<div class="d-flex justify-content-start">
				<h2 class="m-0 text-dark fs-3 fw-semibold">{{ $topJournalist->list_type }}</h2>
			</div>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<livewire:users.top-journalists.top-100 :topJournalist="$topJournalist" />
</div>
@endsection
