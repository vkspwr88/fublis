<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		@yield('head')
		@stack('meta')
		@include('users.includes.google-tags.meta')
		<link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}">
		@include('users.includes.google-tags.script')
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  		<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
		<style>
			.lines, .lines::before, .lines::after{
				background: #000;
				display: block;
			}
			.lines{
				width: 22px;
				height: 2px;
			}
			.lines::before, .lines::after{
				position: absolute;
				content: '';
				height: 3px;
			}
			.lines::before{
				top: 9px;
				width: 1rem;
			}
			.lines::after{
				top: -3px;
				width: 22px;
			}
			#offcanvas{
				background: #000;
			}
			#offcanvas .btn-toggle{
				color: rgb(229, 229, 229);
			}
			button.btn-toggle .menu-toggle-icon::after{
				content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%28229,229,229,1%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
			}
			/* body.shift-left{
				transition: transform 0.8s cubic-bezier(0.15, 0.2, 0.1, 1);
  				transform: scale(0.92) translateX(-466px) translateZ(0px) !important;
			} */

			#modal .preview {
				text-align: center;
				overflow: hidden;
				/* width: 160px; */
				width: 100%;
				height: 160px;
				margin: 10px;
				border: 1px solid red;
				display: block;
				margin: auto;
			}
			#modal .section{
				margin-top:150px;
				background:#fff;
				padding:50px 30px;
			}
			#modal .modal-lg{
				max-width: 1000px !important;
			}
			.cropper-container{
				width: 100% !important;
				/* height: auto !important; */
			}
		</style>
	</head>

	<body id="app1" class="bg-light">
		@include('users.includes.header')
		<section id="body" class="px-0 pb-0 m-0 w-100">
			<div class="container py-5">
				<div class="row align-items-center gy-5">
					<div class="order-2 col-md-5 order-md-1">
						<div class="row g-4">
							@yield('body')
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
						@yield('image')
					</div>
				</div>
			</div>
		</section>
		@include('users.includes.footer')
		{{-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="img-container">
							<div class="row">
								<div class="col-md-8">
									<img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="img-fluid" alt="..." />
								</div>
								<div class="col-md-4">
									<div class="preview w-100"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" id="crop">Crop</button>
					</div>
				</div>
			</div>
		</div> --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
		<script>
			const uploadHostUrl = '{{ route('architect.trix-file-upload') }}';
			// const removeHostUrl = '{{ route('architect.trix-file-remove') }}';
		</script>
		<script src="{{ asset('js/aman.js') }}"></script>
		@stack('scripts')
		<script>
			var sidebarCollapse = document.getElementById("sidebarCollapse");
			var offcanvas_el = document.querySelector("#offcanvas");
			var offcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvas_el);
			offcanvas_el.addEventListener('hide.bs.offcanvas', function () {
				sidebarCollapse.classList.remove('active');
			})
			offcanvas_el.addEventListener('show.bs.offcanvas', function () {
				sidebarCollapse.classList.add('active');
			})
			/* function toggleMyOffcanvas() {
				if (window.innerWidth < 1200) {
					// Prevent hiding animation triggering if page first loaded in mobile view
					offcanvas_el.style.visibility = 'hidden';

					if (offcanvas_el.classList.contains('show')) {
						offcanvas.hide();
					}
				} else {
					if (!offcanvas_el.classList.contains('show')) {
						offcanvas.show();
					}
				}
			} */
			function highlightNav() {
				var paths = location.pathname.split("/"); // uri to array
				paths.shift(); // Remove domain name
				paths = '/' + paths.join('/'); // Add leading slash and join into a string
				paths = (paths == '/') ? '/' : paths.replace(/\/$/, ""); // Remove trailing slash if present
				const menuItem = document.querySelector('.offcanvas-body a[href="' + paths + '"]');
				if (menuItem) {
					menuItem.classList.add('active');
				}
			}
			window.onload = function() {
				// toggleMyOffcanvas();
				highlightNav();
			}
			window.onresize = function() {
				// toggleMyOffcanvas();
			}
		</script>
		@if (session('type') && session('message'))
			<script>
				showAlert({
					'type' : '{{ session('type') }}',
					'message' : '{{ session('message') }}'
				});
			</script>
		@endif
	</body>
</html>
