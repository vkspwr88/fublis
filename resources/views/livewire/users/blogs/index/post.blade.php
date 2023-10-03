<div class="col">
	<div class="card px-5 px-md-5 px-lg-2 px-xl-3 blog-post-card">
		<x-curator-glider class="card-img-top" :media="$blog->homeImage" />
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
