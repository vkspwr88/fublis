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
		<div class="col-sm-5 col-md-4 col-lg-3">
			<div class="position-sticky" style="top: 9rem;">
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="blogSearchInput"><i class="bi bi-search"></i></label>
					<input id="blogSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search">
				</div>
				<x-users.filter.header text="choose category" />
				<x-users.filter.checkbox-list type="category" :list="$categories" />
				<hr class="divider">
				<x-users.filter.header text="choose industry" />
				<x-users.filter.checkbox-list type="indutry" :list="$industries" />
				<hr class="divider">
				<div class="d-grid">
					<button type="button" class="btn btn-white text-capitalize">search</button>
				</div>
			</div>
		</div>
		<div class="col-sm-7 col-md-8 col-lg-9">
			<div class="row row-cols-1 row-cols-lg-2 g-4">
				@foreach ($blogs as $blog)
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<x-curator-glider class="card-img-top" :media="$blog->homeImage" />
						{{-- <img src="{{ $blog->homeImage }}" class="card-img-top" alt="..."> --}}
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold text-capitalize">{{ $blog->author }} <i class="bi bi-dot"></i> {{ $blog->published_date }}</p>
						  	<h5 class="blog-title">{{ $blog->title }}</h5>
						  	<p class="blog-description">{{ $blog->description }}</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}" class="stretched-link"></a>
								@foreach ($blog->tags as $tag)
									<span class="badge rounded-pill badge-indigo">{{ $tag->name }}</span>
								@endforeach
								{{-- <span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span> --}}
							</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<hr class="divider">
			<div class="row g-3 g-md-1">
				<div class="col col-sm order-1 order-sm-1 order-md-1 text-start text-nowrap">
					<button type="button" class="btn btn-white btn-sm text-capitalize"><i class="bi bi-arrow-left-short"></i> previous</button>
				</div>
				<div class="col-12 col-sm-auto order-3 order-sm-3 order-md-2 text-center">
					<nav aria-label="...">
						<ul class="pagination pagination-sm justify-content-center m-0">
							<li class="page-item" aria-current="page">
								<span class="page-link px-3 border bg-white text-dark rounded">1</span>
							</li>
							<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">2</a></li>
							<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">3</a></li>
							<li class="page-item" aria-current="page">
								<span class="page-link px-3 border-0 bg-transparent text-dark rounded">...</span>
							</li>
							<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">8</a></li>
							<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">9</a></li>
							<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">10</a></li>
						</ul>
					</nav>
				</div>
				<div class="col col-sm order-2 order-sm-2 order-md-3 text-end text-nowrap">
					<button type="button" class="btn btn-white btn-sm text-capitalize">next <i class="bi bi-arrow-right-short"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
