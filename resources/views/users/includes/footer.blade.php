<footer id="footer">
	<div id="footer1" class="bg-white py-5">
		<div class="container">
			<div class="row g-5">
				<div class="col-md-4">
					<p class="mb-5">
						<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="footer-logo">
					</p>
					<p>
						Now its easy more than ever to pitch and find stories for publication worldwide.
					</p>
				</div>
				<div class="col-md-8">
					<div class="footer-nav d-flex flex-column flex-sm-row justify-content-lg-evenly flex-wrap">
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
									<x-users.footer.nav-links href="javascript:;" text="blog" />
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
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="twitter" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="linkedin" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="facebook" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="instagram" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="pinterest" />
								</li>
								<li class="nav-item">
									<x-users.footer.nav-links href="javascript:;" text="snapchat" />
								</li>
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
	</div>
	<div id="footer2" class="py-3">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<p class="d-flex justify-content-center justify-content-md-start align-items-center h-100 m-md-0">
						<i class="bi bi-c-circle"></i> {{ date('Y') }} {{ env('COMPANY_NAME') }} All rights reserved.
					</p>
				</div>
				<div class="col-md-5">
					<ul class="nav justify-content-center justify-content-md-end">
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-twitter-x"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-linkedin"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-facebook"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-github"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-instagram"></i></a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-muted" href="#"><i class="bi bi-dribbble"></i></a>
						</li>
					  </ul>
				</div>
			</div>
		</div>
	</div>
</footer>
