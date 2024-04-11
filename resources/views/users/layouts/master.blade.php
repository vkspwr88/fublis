<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		@yield('head')
		@stack('meta')
		<link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}">

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  		<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
		<style>
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
		<section id="body" class="w-100 m-0 px-0 pb-0">
			@yield('body')
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
