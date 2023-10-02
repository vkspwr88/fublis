@extends('users.layouts.master')

@section('head')
{!! seo($seoData) /* seo()->for($blog) */ !!}
@endsection

@section('body')
<section id="blog" class="bg-white py-5">
	<div class="container">
		<div class="blog-header pb-5">
			<p class="blog-tags">
				@foreach ($blog->tags as $tag)
					<span class="badge rounded-pill badge-indigo">{{ $tag->name }}</span>
				@endforeach
			</p>
			<h1 class="text-gray-900 mb-4">{{ $blog->title }}</h1>
			<p class="text-gray-600 mb-5">{{ $blog->description }}</p>
			<div class="mb-4">
				<x-curator-glider class="img-fluid" :media="$blog->bannerImage"  style="width: 100%;" />
			</div>
			<div class="row g-4">
				<div class="col-auto">
					<h5 class="fublis-header">Written by</h5>
					<h6 class="fublis-body text-capitalize">{{ $blog->author }}</h6>
				</div>
				<div class="col-auto">
					<h5 class="fublis-header">Published on</h5>
					<h6 class="fublis-body">{{ $blog->published_date }}</h6>
				</div>
				<div class="col">
					<div class="d-grid gap-2 d-flex justify-content-end">
						<button class="btn btn-white text-nowrap" type="button"><i class="bi bi-copy"></i> Copy link</button>
						<button class="btn btn-white text-gray-300" type="button"><i class="bi bi-twitter"></i></button>
						<button class="btn btn-white text-gray-300" type="button"><i class="bi bi-facebook"></i></button>
						<button class="btn btn-white text-gray-300" type="button"><i class="bi bi-linkedin"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-body py-5">
			<div class="row g-4">
				<div class="col-md-8">
					<div class="blog-content pe-5">
						{!! $blog->body !!}
						{{-- <h4 class="text-gray-900 fw-bold mb-4">Introduction</h4>
						<p class="text-gray-600">Mi tincidunt elit, id quisque ligula ac diam, amet. Vel etiam suspendisse morbi eleifend faucibus eget vestibulum felis. Dictum quis montes, sit sit. Tellus aliquam enim urna, etiam. Mauris posuere vulputate arcu amet, vitae nisi, tellus tincidunt. At feugiat sapien varius id.</p>
						<p class="text-gray-600">Eget quis mi enim, leo lacinia pharetra, semper. Eget in volutpat mollis at volutpat lectus velit, sed auctor. Porttitor fames arcu quis fusce augue enim. Quis at habitant diam at. Suscipit tristique risus, at donec. In turpis vel et quam imperdiet. Ipsum molestie aliquet sodales id est ac volutpat.</p> --}}
					</div>
				</div>
				<div class="col-md-4">
					<div class="card bg-gray-50 border-0 rounded-0 border-top border-4 border-purple-700">
						<div class="card-body">
							<p class="text-body">
								<span class="bg-pink-100 circle-icon rounded-circle fs-5 d-inline-block"><i class="bi bi-send"></i></span>
							</p>
							<h5 class="text-gray-900 fw-bold">Weekly newsletter</h5>
							<p class="text-gray-600">No spam. Just the latest releases and tips, interesting articles, and exclusive interviews in your inbox every week.</p>
							<livewire:users.blogs.show.subscribe1 />
							{{-- <div class="d-flex justify-content-center">
								<div class="subscribe-input me-1 me-sm-2">
									<input type="text" name="" id="" class="form-control" placeholder="Enter your email">
									<div class="form-text position-absolute"><small>We care about your data in our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div>
								</div>
								<div class="subscribe-button">
									<button class="btn btn-primary text-capitalize" type="button">subscribe</button>
								</div>
							</div> --}}
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="latestBlog" class="bg-white py-5">
	<div class="container">
		<div class="section-content">
			<h6 class="text-center section-subtitle">Latest posts</h6>
			<h4 class="text-center section-title">Fublis Blog</h4>
			<p class="text-center section-description">Interviews, tips, guides, industry best practices, and news.</p>
		</div>
		<div class="row g-4 g-md-3">
			@foreach ($latestBlogs as $latestBlog)
			<div class="col-md-4">
				<div class="card px-5 px-md-0 px-lg-2 px-xl-3 blog-post-card">
					<x-curator-glider class="card-img-top" :media="$latestBlog->homeImage" />
					<div class="card-body px-0 pt-4">
						<p class="blog-author fw-bold text-capitalize">{{ $latestBlog->author }} <i class="bi bi-dot"></i> {{ $latestBlog->published_date }}</p>
						  <h5 class="blog-title">{{ $latestBlog->title }}</h5>
						  <p class="blog-description">{{ $latestBlog->description }}</p>
						  <p class="blog-tags">
							<a href="{{ route('blogs.show', ['slug' => $latestBlog->slug]) }}" class="stretched-link"></a>
							@foreach ($latestBlog->tags as $tag)
								<span class="badge rounded-pill badge-purple">{{ $tag->name }}</span>
							@endforeach
						</p>
					</div>
				</div>
			</div>
			@endforeach

			{{-- <div class="col-md-4">
				<div class="card px-5 px-md-0 px-lg-2 px-xl-3 blog-post-card">
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
			<div class="col-md-4">
				<div class="card px-5 px-md-0 px-lg-2 px-xl-3 blog-post-card">
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
			</div> --}}
		</div>
		<p class="text-center">
			<a href="{{ route('blogs.index') }}" class="btn btn-primary text-capitalize">view all posts</a>
		</p>
	</div>
</section>

<section id="joinUs" class="bg-white p-0">
	<div class="container-fluid p-0">
		<div class="row g-0">
			<div class="col-md-6 align-self-center">
				<div class="d-flex flex-column">
					<div class="align-self-center">
						<h2 class="fw-bold text-gray-900 mb-4">Join 4,000+ startups<br>growing with Fublis</h2>
						<p class="text-gray-600 mb-1 ms-2"><span class="text-purple-600"><i class="bi bi-check-circle"></i></span> 30-day free trial</p>
						<p class="text-gray-600 mb-1 ms-2"><span class="text-purple-600"><i class="bi bi-check-circle"></i></span> Peronalized onboarding</p>
						<p class="text-gray-600 mb-4 ms-2"><span class="text-purple-600"><i class="bi bi-check-circle"></i></span> Access to all features</p>
						<p>
							<button type="button" class="btn btn-white text-capitalize me-2">learn more</button>
							<button type="button" class="btn btn-primary text-capitalize">get started</button>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="position-relative end-0" style="max-width: 696px;">
					<img class="img-fluid" src="https://placehold.co/696x616" alt="">
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container-fluid p-0 blog-newsletter-container">
	<div class="bg-gray-50 py-5 px-3 text-center text-white">
		<div class="col-md-8 offset-md-2 py-5">
			<h2 class="mb-4 fw-bold">Sign up for our newsletter</h2>
			<p class="mx-auto mb-4">Be the first to know about releases and industry news and insights.</p>
			{{-- <div class="d-flex justify-content-center">
				<div class="subscribe-input me-1 me-sm-2">
					<input type="text" name="" id="" class="form-control" placeholder="Enter your email">
					<div class="form-text position-absolute"><small>We care about your data in our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div>
				</div>
				<div class="subscribe-button">
					<button class="btn btn-primary text-capitalize" type="button">subscribe</button>
				</div>
			</div> --}}
			<livewire:users.blogs.show.subscribe2 />
		</div>
	</div>
</div>
@endsection
