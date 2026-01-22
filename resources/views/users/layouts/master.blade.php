<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		@yield('head')
		@stack('meta')
		@include('users.includes.google-tags.meta')
		{{-- <link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}"> --}}
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
		<link rel="manifest" href="{{ asset('site.webmanifest') }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}?v=1.01">
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
			@if(isArchitect())
				@php
					$totalPendingRequests = App\Services\DownloadRequestService::getPendingRequestsQuery()->count();
				@endphp
				@if ($totalPendingRequests)
					<div class="container">
						<div class="row">
							<div class="py-5 bg-purple-600 col-12">
								<div class="px-md-5 px-sm-4">
									<div class="row g-4">
										<div class="col-md">
											<div class="text-white pe-md-5">
												<h2 class="mb-4 fs-4">Pending Publication Requests</h2>
												<p class="fs-6">You have {{ $totalPendingRequests }} pending publication requests, approve them to get published. You can approve or decline these requests.</p>
											</div>
										</div>
										<div class="col-md-auto text-md-end">
											<a href="{{ route('architect.account.profile.requests') }}" class="text-purple-600 btn btn-white fs-6 fw-semibold">Manage Requests</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endif
			@yield('body')
		</section>
		@include('users.includes.footer')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
		<script>
			const uploadHostUrl = '{{ route('architect.trix-file-upload') }}';
			// const removeHostUrl = '{{ route('architect.trix-file-remove') }}';
		</script>
		<script src="{{ asset('js/aman.js') }}?v=1.01"></script>
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
