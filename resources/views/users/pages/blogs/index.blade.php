@extends('users.layouts.master')

@section('title', 'Blogs')

@section('body')
<div class="container-fluid p-0 blog-hero-container">
	<div class="bg-purple-800 py-5 px-3 text-center text-white">
		<div class="col-md-8 offset-md-2 py-5">
			<h2 class="text-capitalize mb-4 fw-bold">resources, interviews & stories</h2>
			<p class="text-pink-200 mx-auto mb-4">Subscribe to learn about the latest industry news, interviews, technologies, and resources.</p>
			<div class="d-flex justify-content-center">
				<div class="subscribe-input me-1 me-sm-2">
					<input type="text" name="" id="" class="form-control" placeholder="Enter your email">
					<div class="form-text position-absolute"><small>We care about your data in our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div>
				</div>
				<div class="subscribe-button">
					<button class="btn btn-primary text-capitalize" type="button">subscribe</button>
				</div>
			</div>
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
				<x-users.filter.checkbox-list type="category" :list="$category" />
				<hr class="divider">
				<x-users.filter.header text="choose industry" />
				<x-users.filter.checkbox-list type="indutry" :list="$industry" />
				<hr class="divider">
				<div class="d-grid">
					<button type="button" class="btn btn-white text-capitalize">search</button>
				</div>
			</div>
		</div>
		<div class="col-sm-7 col-md-8 col-lg-9">
			<div class="row row-cols-1 row-cols-lg-2 g-4">
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
						<img src="https://placehold.co/550x400" class="card-img-top" alt="...">
						<div class="card-body px-0 pt-4">
							<p class="blog-author fw-bold">Olivia Rhya <i class="bi bi-dot"></i> 20 Jan 2022</p>
						  	<h5 class="blog-title">Build your API Stack</h5>
						  	<p class="blog-description">How do you create compelling presentations that wow your colleagues and impress your managers?</p>
						  	<p class="blog-tags">
								<a href="{{ route('blogs.show') }}" class="stretched-link"></a>
								<span class="badge rounded-pill badge-purple">Design</span>
								<span class="badge rounded-pill badge-indigo">Research</span>
								<span class="badge rounded-pill badge-pink">Presentation</span>
							</p>
						</div>
					</div>
				</div>
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
