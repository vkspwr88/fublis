@extends('users.layouts.master')

@section('title', 'Blogs')

@section('body')
<div class="container-fluid p-0" id="blogHeroSection">
	<div class="bg-purple-800 py-5 px-3 text-center text-white">
		<div class="col-md-8 offset-md-2 pb-4">
			<h2 class="text-capitalize mb-4">resources, interviews & stories</h2>
			<p class="text-pink-200 mx-auto mb-4">Subscribe to learn about the latest industry news, interviews, technologies, and resources.</p>
			<div class="d-flex justify-content-center">
				<div class="subscribe-input me-1 me-sm-3">
					<input type="text" name="" id="" class="form-control" placeholder="Enter your email">
					<div class="form-text position-absolute">We care about your data in our privacy policy.</div>
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
		<div class="col-md-3">
			<div class="position-sticky" style="top: 9rem;">
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="blogSearchInput"><i class="bi bi-search"></i></label>
					<input id="blogSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search">
				</div>
				<x-users.filter-header text="choose category" />
				<div class="filter-checkbox-container">
					<div class="form-check">
						<input class="form-check-input filter-checkbox" type="checkbox" value="" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
					</div>
					<div class="form-check">
						<input class="form-check-input filter-checkbox" type="checkbox" value="" id="flexCheckChecked">
						<label class="form-check-label" for="flexCheckChecked">Checked checkbox</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8" style="height: 1500px;"></div>
	</div>
</div>
@endsection
