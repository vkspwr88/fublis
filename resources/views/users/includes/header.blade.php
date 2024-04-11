
<header id="header" class="bg-white shadow-sm navbar navbar-expand-xl fixed-top m-0 p-0">
	<div class="container h-100">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button id="sidebarCollapse" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
			<span class="navbar-toggler-icon"></span>
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
					<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
				</a>
			  	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				@if(isArchitect())
					@include('users.includes.headers.mobile-nav-architect')
				@elseif(isJournalist())
					@include('users.includes.headers.mobile-nav-journalist')
				@else
					@include('users.includes.headers.mobile-nav-guest')
				@endif
				{{-- <ul class="mb-2 navbar-nav">

					<li class="nav-item">
						<a class="nav-link {{ request()->segment(2) === 'add-story' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'add-story' ? 'aria-current=page' : '' }} href="{{ route('architect.add-story.index') }}">Add Story</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ request()->segment(1) === 'media-kit' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'media-kit' ? 'aria-current=page' : '' }} href="{{ route('architect.media-kit.index') }}">Media Kits</a>
					</li>
					<li class="nav-item">
						<a class="nav-link {{ request()->segment(2) === 'pitch-story' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'pitch-story' ? 'aria-current=page' : '' }} href="{{ route('architect.pitch-story.index') }}">Pitch Story</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Resources
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="{{ route('pricing') }}">Pricing</a></li>
							<li><a class="dropdown-item" href="#">Action</a></li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Something else here</a></li>
						</ul>
					</li>
				</ul>
				<form class="my-5 d-flex my-xl-0" aria-label="search">
					<div class="input-group">
						<label class="bg-white input-group-text" for="headerSearchInput"><i class="bi bi-search"></i></label>
						<input id="headerSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search Journalists, Publications" aria-label="Search">
					</div>
				</form> --}}
				{{-- <ul id="profileNav" class="flex-row mt-5 navbar-nav mt-xl-0 ms-xl-auto align-items-center">
					<livewire:common.header.message :url="route('architect.account.profile.message.index')" />
					<livewire:common.header.notification :url="route('architect.account.profile.notification')" />
					<li class="px-2 nav-item px-xl-1 dropdown">
						<a href="javascript:;" class="p-0 nav-link rounded-circle" role="button" data-bs-toggle="dropdown">
							<img class="rounded-circle img-40 img-square" src="{{ $profileImage }}" alt="..." />
						</a>
						<ul class="dropdown-menu profile-dropdown">
							<li><a class="dropdown-item" href="{{ route('architect.account.studio.index') }}">Studio</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.index') }}">Profile</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.analytic') }}">Analytics</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.alert') }}">Alerts</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.notification') }}">Notifications</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.message.index') }}">Messages</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.invite-colleague') }}">Invite Colleague</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.account.profile.setting.personal-info') }}">Settings</a></li>
							<li><a class="dropdown-item" href="{{ route('architect.logout') }}">Log Out</a></li>
						</ul>
					</li>
				</ul> --}}
			</div>
		</div>
	</div>
</header>
