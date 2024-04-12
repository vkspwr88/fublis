<footer id="footer">
	<div class="bg-footer-black py-5">
		<div class="container py-5">
			<div class="row text-center gy-5">
				<div class="col-12">
					<h4 class="text-white">Subscribe and never miss out</h4>
					<livewire:users.blogs.index.subscribe-newsletter />
				</div>
				<div class="col-12">
					<ul class="nav justify-content-center" id="bannerFooterNav">
						<li class="nav-item">
						  	<a class="nav-link text-white" href="https://www.fublis.com">Home</a>
						</li>
						<li class="nav-item">
						  	<a class="nav-link text-white" href="https://app.fublis.com/">Platform</a>
						</li>
						<li class="nav-item">
						  	<a class="nav-link text-white" href="https://blog.fublis.com/">Magazine</a>
						</li>
						<li class="nav-item">
						  	<a class="nav-link text-white" href="https://help.fublis.com/">Help Center</a>
						</li>
					</ul>
				</div>
				<div class="col-12">
					<h1 id="fullWidthHeader" class="m-0 p-0 lh-1 text-white fw-bold">FUBLIS NOW</h1>
				</div>
			</div>
		</div>
	</div>
	<div id="footer1" class="bg-white py-5">
		<div class="container">
			<div class="row g-4">
				@include('users.includes.footers.nav')
			</div>
		</div>
	</div>
	{{-- <div id="footer1" class="bg-white py-5">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-4 text-center text-md-start">
					<p class="mb-4 mb-md-5">
						<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="footer-logo">
					</p>
					<p>
						Now its easy more than ever to pitch and find stories for publication worldwide.
					</p>
				</div>
				<div class="col-md-8">
					<div class="footer-nav d-flex flex-column flex-sm-row justify-content-lg-evenly flex-wrap text-center text-sm-start">
						<div class="">
							<x-users.footer.heading text="platform" />
							<ul class="nav flex-column footer-list">
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Media Database" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Pitch Releases" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Pitch Articles" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Pitch Projects" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Media Monitoring" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="Media Kits" />
								</li>
							</ul>
						</div>
						<div class="">
							<x-users.footer.heading text="company" />
							<ul class="nav flex-column footer-list">
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="about us" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="careers" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="press" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="news" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="media kit" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="contact" />
								</li>
							</ul>
						</div>
						<div class="">
							<x-users.footer.heading text="resources" />
							<ul class="nav flex-column footer-list">
								<li class="nav-item">
									<x-users.footer.nav-links href="{{ route('blogs.index') }}" text="blog" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="newsletter" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="events" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="help center" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="top publications" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="support" />
								</li>
							</ul>
						</div>
						<div class="">
							<x-users.footer.heading text="social" />
							<ul class="nav flex-column footer-list">
								@foreach ($socialMedias as $socialMedia)
									<li class="nav-item">
										<x-users.footer.nav-links href="{{ $socialMedia->url }}" text="{{ $socialMedia->name }}" target="_blank" />
									</li>
								@endforeach
							</ul>
						</div>
						<div class="">
							<x-users.footer.heading text="legal" />
							<ul class="nav flex-column footer-list">
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="terms" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="privacy" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="cookies" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="licenses" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="settings" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="contact" />
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	<div id="footer2" class="py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<p class="d-flex justify-content-center justify-content-md-start align-items-center h-100 m-md-0 text-muted">
						<i class="bi bi-c-circle me-1"></i> {{ date('Y') }} {{ env('COMPANY_NAME') }} All rights reserved.
					</p>
				</div>
				<div class="col-md-5">
					<ul id="socialNav" class="nav justify-content-center justify-content-md-end">
						@foreach ($socialMedias as $socialMedia)
						<li class="nav-item">
							<a class="nav-link text-muted px-2" href="{{ $socialMedia->url }}" target="_blank">{!! $socialMedia->icon !!}</a>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
