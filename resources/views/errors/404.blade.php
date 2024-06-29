@extends('users.layouts.master')

@section('head')
	<title>404 - Not Found</title>
@endsection

@section('body')
<div class="container py-5">
	<div class="row align-items-center gy-5">
		<div class="order-2 col-md-5 order-md-1">
			<div class="row g-4">
				<div class="col-12">
					<h6 class="m-0 text-purple-700 fw-semibold">404 error</h6>
				</div>
				<div class="col-12">
					<h2 class="m-0 fs-1 fw-bold text-dark">We lost this page</h2>
				</div>
				<div class="col-12">
					<p class="m-0 text-secondary">Sorry, the page you are looking for doesn't exist.</p>
				</div>
				<div class="col-12">
					<form action="" class="m-0">
						<div class="input-group">
							<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
							<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search our site" aria-label="Search" wire:model="name" />
							<button class="btn btn-primary fw-semibold" type="button" id="button-addon2">Search</button>
						</div>
					</form>
				</div>
				<div class="col-12">
					<div class="row g-4">
						<div class="col-12">
							<p class="m-0">
								<a href="{{ route('home') }}" class="text-purple-700 fw-semibold">Platform <i class="bi bi-arrow-right"></i></a>
								<br>
								<span class="text-secondary">Dive in to learn all about Fublis.</span>
							</p>
						</div>
						<div class="col-12">
							<p class="m-0">
								<a href="https://www.blog.fublis.com" target="_blank" class="text-purple-700 fw-semibold">Magazine <i class="bi bi-arrow-right"></i></a>
								<br>
								<span class="text-secondary">Read the latest posts on our blog.</span>
							</p>
						</div>
						<div class="col-12">
							<p class="m-0">
								<a href="https://www.help.fublis.com" target="_blank" class="text-purple-700 fw-semibold">Help Center <i class="bi bi-arrow-right"></i></a>
								<br>
								<span class="text-secondary">Our friendly team is here to help.</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="order-1 col-md-6 offset-md-1 order-md-2">
			<img src="{{ asset('images/errors/fublis-404.png') }}" class="img-fluid" alt="404 Not found">
		</div>
	</div>
</div>
@endsection
