<nav id="header" class="navbar navbar-expand-xl bg-white fixed-top shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		{{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button> --}}
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
			<div class="offcanvas-header">
				<a class="navbar-brand" href="{{ route('home') }}">
					<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
				</a>
			  	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			@if(isArchitect())
				@include('users.includes.header-architect')
			@elseif(isJournalist())
				@include('users.includes.header-journalist')
			@else
				@include('users.includes.header-guest')
			@endif
		</div>

		{{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id="headerNav" class="navbar-nav ms-5 me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link px-3 active" aria-current="page" href="#">Add Story</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-3" href="#">Media Kits</a>
				</li>
				<li class="nav-item">
					<a class="nav-link px-3" href="#">Pitch Story</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link px-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
						aria-expanded="false">
						Resources
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="#">Action</a></li>
						<li><a class="dropdown-item" href="#">Another action</a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item" href="#">Something else here</a></li>
					</ul>
				</li>
			</ul>
			<form class="d-flex" role="search">
				<div class="input-group">
					<label class="input-group-text bg-white" for="headerSearchInput"><i class="bi bi-search"></i></label>
					<input id="headerSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search journalists, publications" aria-label="Search">
				</div>
			</form>
			<ul id="profileNav" class="navbar-nav ms-auto">
				<li class="nav-item px-1">
					<a href="javascript:;" class="nav-link text-purple border border-2 border-purple rounded-circle lh-1">
						<i class="bi bi-envelope"></i>
					</a>
				</li>
				<li class="nav-item px-1">
					<a href="javascript:;" class="nav-link text-purple border border-2 border-purple rounded-circle lh-1">
						<i class="bi bi-bell"></i>
					</a>
				</li>
				<li class="nav-item px-1">
					<a href="javascript:;" class="nav-link text-purple border border-2 border-purple rounded-circle lh-1">
						<i class="bi bi-person-fill"></i>
					</a>
				</li>
			</ul>
		</div> --}}
	</div>
</nav>
