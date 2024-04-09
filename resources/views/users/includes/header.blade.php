
<header id="header" class="bg-white shadow-sm navbar navbar-expand-xl fixed-top m-0 p-0">
	<div class="container h-100">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<nav id="headerNav" class="d-flex h-100 w-100">
			@if(isArchitect())
				@include('users.includes.nav-architect')
			@elseif(isJournalist())
				@include('users.includes.nav-journalist')
			@else
				@include('users.includes.nav-guest')
			@endif
		</nav>
	</div>
</header>
