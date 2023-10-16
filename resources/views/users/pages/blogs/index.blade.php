@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container-fluid p-0 blog-hero-container">
	<div class="bg-purple-800 py-5 px-3 text-center text-white">
		<div class="col-md-8 offset-md-2 py-5">
			<h2 class="text-capitalize mb-4 fw-bold">resources, interviews & stories</h2>
			<p class="text-pink-200 mx-auto mb-4">Subscribe to learn about the latest industry news, interviews, technologies, and resources.</p>
			<livewire:users.blogs.index.subscribe-newsletter />
		</div>
	</div>
</div>

<div class="container py-5">
	<div class="row">
		<div class="col-lg-3 col-xl-3">
			<div class="filter-btn text-end pb-3">
				<button class="btn btn-primary rounded-0" data-bs-toggle="collapse" data-bs-target="#collapsedFilter" aria-expanded="false" aria-controls="collapsedFilter">
					<i class="bi bi-filter"></i>
				</button>
			</div>
			<div class="position-relative">
				<div class="filter-container" id="collapsedFilter">
					<livewire:users.blogs.index.filter />
				</div>
			</div>
		</div>
		<div class="col-lg-9 col-xl-9">
			<livewire:users.blogs.index.posts />
		</div>
	</div>
</div>
@endsection
