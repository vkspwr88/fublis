
<header id="header" class="p-0 m-0 bg-white shadow-sm navbar navbar-expand-xl fixed-top">
	<div class="px-3 px-sm-5 container-fluid h-100">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button id="sidebarCollapse" class="border-0 shadow-none navbar-toggler position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
			<span class="lines"></span>
			{{-- <span class="navbar-toggler-icon"></span> --}}
		</button>
		{{-- <button id="sidebarCollapse" class="float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button" aria-label="Toggle menu">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</button> --}}
		<nav id="headerNav" class="d-none d-xl-flex h-100 w-100 align-items-center">
			@if(isArchitect())
				@include('users.includes.headers.nav-architect')
			@elseif(isJournalist())
				@include('users.includes.headers.nav-journalist')
			@else
				@include('users.includes.headers.nav-guest')
			@endif
		</nav>
		<div class="offcanvas offcanvas-end d-flex d-xl-none" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
			<div class="offcanvas-header">
				<a class="navbar-brand" href="{{ route('home') }}">
					<img src="{{ asset(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
				</a>
			  	<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				@if(isArchitect())
					@include('users.includes.headers.mobile-nav-architect')
				@elseif(isJournalist())
					@include('users.includes.headers.mobile-nav-journalist')
				@else
					@include('users.includes.headers.mobile-nav-guest')
				@endif
			</div>
		</div>
	</div>
</header>
