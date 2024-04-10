@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="py-5">
	<div class="container py-5">
		<div class="row g-4 text-center">
			<div class="col-md-12">
				<ul id="userTab" class="nav nav-pills justify-content-center" aria-label="User Tab">
					<li class="p-1 bg-purple-100 nav-item pe-0" role="presentation">
						<button class="py-2 nav-link active" id="architectTab" data-bs-toggle="pill" data-bs-target="#architectTabContent" type="button" role="tab" aria-controls="architectTabContent" aria-selected="true">Join Fublis</button>
					</li>
					<li class="p-1 bg-purple-100 nav-item ps-0" role="presentation">
						<button class="py-2 nav-link" id="journalistTab" data-bs-toggle="pill" data-bs-target="#journalistTabContent" type="button" role="tab" aria-controls="journalistTabContent" aria-selected="false">Join as Journalist <i class="bi bi-arrow-right"></i></button>
					</li>
				</ul>
			</div>
			<div class="col-md-12">
				<div class="tab-content" id="userTabContent">
					<div class="tab-pane fade show active" id="architectTabContent" role="tabpanel" aria-labelledby="architectTab">
						<div class="text-center row g-4">
							<div class="col-12">
								<h2 class="m-0 fs-1 fw-semibold text-dark">
									Why Advertise when you can
									<br>
									<span class="fublis-line-through">
										Publish
										<img src="{{ asset('images/utility/linethrough.png') }}" class="overlay" alt=""></img>
									</span>
									<span class="text-purple-700">Fublis.</span>
								</h2>
							</div>
							<div class="col-12">
								<p class="m-0 text-secondary">
									Unlimitedt Press Releases/ Projects/ Stories/
									<br>
									Designs on Multiple Platforms Worldwide.
								</p>
							</div>
							<div class="col-12">
								<p class="m-0">
									<a href="{{ route('architect.login') }}" class="btn btn-white fw-semibold">Sign In</a>
									<a href="{{ route('architect.signup') }}" class="btn btn-primary fw-semibold">Create free account</a>
								</p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="journalistTabContent" role="tabpanel" aria-labelledby="journalistTab">
						<div class="text-center row g-4">
							<div class="col-12">
								<h2 class="m-0 fs-1 fw-semibold text-dark">
									Find fresh stories for your
									<br>
									Publishing Platform
								</h2>
							</div>
							<div class="col-12">
								<p class="m-0 text-secondary">
									'Ready-to-Publish' Fresh Press Releases/ Projects
									<br>
									/ Stories / Designs Worldwide.
								</p>
							</div>
							<div class="col-12">
								<p class="m-0">
									<a href="{{ route('journalist.login') }}" class="btn btn-white fw-semibold">Sign In</a>
									<a href="{{ route('journalist.signup') }}" class="btn btn-primary fw-semibold">Create free account</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<img src="{{ asset('images/home/fublis-banner.png') }}" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</div>
@endsection
