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
				<livewire:users.blogs.index.filter />
			</div>
		</div>
		<div class="col-sm-7 col-md-8 col-lg-9">
			<livewire:users.blogs.index.posts />
		</div>
	</div>
</div>
@endsection
