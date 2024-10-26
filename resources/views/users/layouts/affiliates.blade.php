<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		{!! seo($SEOData ?? null) !!}
		@yield('head')
		@stack('meta')
		<link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet">
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style-portal.css') }}">
		@include('users.includes.google-tags.script')
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<style>
			h2#pageTitle{
				margin-bottom: 2.5rem;
				color: var(--fublis-gray-900);
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row flex-nowrap gx-5">
				<div class="col-auto px-0 col-md-3 col-xl-2 px-sm-2 bg-dark">
					<div class="px-3 pt-2 text-white d-flex flex-column align-items-center align-items-sm-start min-vh-100">
						<a href="/" class="pb-3 text-white d-flex align-items-center mb-md-0 me-md-auto text-decoration-none">
							<span class="fs-5 d-none d-sm-inline">
								<img src="{{ asset(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('APP_NAME') }}" style="width: 150px; margin-top: 5px;">
							</span>
							{{-- <img src="{{ asset(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('APP_NAME') }}" style="width: 150px; margin-top: 5px;"> --}}
						</a>
						<ul class="mb-0 nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start" id="menu">
							<li class="nav-item">
								<a href="#" class="px-0 text-white align-middle nav-link">
									<i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="px-0 align-middle nav-link">
									<i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
								</a>
							</li>
							{{-- <li>
								<a href="#submenu1" data-bs-toggle="collapse" class="px-0 align-middle nav-link">
									<i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
								<ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
									<li class="w-100">
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Item</span> 1 </a>
									</li>
									<li>
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Item</span> 2 </a>
									</li>
								</ul>
							</li> --}}
							<li>
								<a href="#" class="px-0 align-middle nav-link">
									<i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
							</li>
							<li>
								<a href="#submenu2" data-bs-toggle="collapse" class="px-0 align-middle nav-link ">
									<i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
								<ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
									<li class="w-100">
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Item</span> 1</a>
									</li>
									<li>
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Item</span> 2</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#submenu3" data-bs-toggle="collapse" class="px-0 align-middle nav-link">
									<i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
									<ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
									<li class="w-100">
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Product</span> 1</a>
									</li>
									<li>
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Product</span> 2</a>
									</li>
									<li>
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Product</span> 3</a>
									</li>
									<li>
										<a href="#" class="px-0 nav-link"> <span class="d-none d-sm-inline">Product</span> 4</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="#" class="px-0 align-middle nav-link">
									<i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
							</li>
						</ul>
						<hr>
						<div class="pb-4 dropdown">
							<a href="#" class="text-white d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
								<span class="mx-1 d-none d-sm-inline">loser</span>
							</a>
							<ul class="shadow dropdown-menu dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
								<li><a class="dropdown-item" href="#">New project...</a></li>
								<li><a class="dropdown-item" href="#">Settings</a></li>
								<li><a class="dropdown-item" href="#">Profile</a></li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li><a class="dropdown-item" href="#">Sign out</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="py-5 col">
					<div class="px-4 pt-4 page-body">
						{{-- <h2 id="pageTitle">Left Sidebar with Submenus</h2> --}}
						@yield('body')
					</div>
					{{-- <h3>Left Sidebar with Submenus</h3> --}}
					{{-- <p class="lead">
						An example 2-level sidebar with collasible menu items. The menu functions like an "accordion" where only a single
						menu is be open at a time. While the sidebar itself is not toggle-able, it does responsively shrink in width on smaller screens.</p>
					<ul class="list-unstyled">
						<li><h5>Responsive</h5> shrinks in width, hides text labels and collapses to icons only on mobile</li>
					</ul> --}}
				</div>
			</div>
		</div>
	</body>
</html>
