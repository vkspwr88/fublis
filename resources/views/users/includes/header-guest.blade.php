<div class="offcanvas-body">
	<ul id="headerNav" class="navbar-nav ms-xl-5 me-xl-auto mb-2 mb-xl-0">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Architect
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="{{ route('architect.login') }}">Log In</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.signup') }}">Sign Up</a></li>
			</ul>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Journalist
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="{{ route('journalist.login') }}">Log In</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.signup') }}">Sign Up</a></li>
			</ul>
		</li>
		@use('App\Http\Controllers\Users\TopPublicationController', 'TopPublicationController')
		@php
			$topPublicationRecords = TopPublicationController::getAll();
		@endphp
		@if($topPublicationRecords->count())
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Top Publications
			</a>
			<ul class="dropdown-menu">
				@foreach ($topPublicationRecords as $topPublication)
					<li><a class="dropdown-item" href="{{ route('top-100-publications', ['categorySlug' => $topPublication->category_slug, 'countrySlug' => $topPublication->location_slug]) }}">{{ $topPublication->list_type }}</a></li>
				@endforeach

				{{-- <li><a class="dropdown-item" href="{{ route('top-100-publications', ['categorySlug' => 'architecture', 'countrySlug' => 'india']) }}">Top 100 Publications in Architecture in India</a></li> --}}
			</ul>
		</li>
		@endif
		@use('App\Http\Controllers\Users\TopJournalistController', 'TopJournalistController')
		@php
			$topJournalistRecords = TopJournalistController::getAll();
		@endphp
		@if($topJournalistRecords->count())
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Top Journalists
			</a>
			<ul class="dropdown-menu">
				@foreach ($topJournalistRecords as $topJournalist)
					<li><a class="dropdown-item" href="{{ route('top-100-journalists', ['categorySlug' => $topJournalist->category_slug, 'countrySlug' => $topJournalist->location_slug]) }}">{{ $topJournalist->list_type }}</a></li>
				@endforeach
				{{-- <li><a class="dropdown-item" href="{{ route('top-100-journalists', ['categorySlug' => 'architecture', 'countrySlug' => 'united-states']) }}">Top 100 Journalists in Architecture in United States</a></li>
				<li><a class="dropdown-item" href="{{ route('top-100-journalists', ['categorySlug' => 'architecture', 'countrySlug' => 'india']) }}">Top 100 Journalists in Architecture in India</a></li> --}}
			</ul>
		</li>
		@endif
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
	{{-- <form class="d-flex my-5 my-xl-0" aria-label="search">
		<div class="input-group">
			<label class="input-group-text bg-white" for="headerSearchInput"><i class="bi bi-search"></i></label>
			<input id="headerSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search journalists, publications" aria-label="Search">
		</div>
	</form> --}}
	{{-- <ul id="profileNav" class="navbar-nav mt-5 mt-xl-0 ms-xl-auto flex-row">
		<li class="nav-item px-2 ps-0 px-xl-1">
			<a href="javascript:;" class="nav-link text-center text-purple-600 border border-2 border-purple-600 rounded-circle lh-1">
				Login
			</a>
		</li>
		<li class="nav-item px-2 px-xl-1">
			<a href="javascript:;" class="nav-link text-center text-purple-600 border border-2 border-purple-600 rounded-circle lh-1">
				Register
			</a>
		</li>
	</ul> --}}
</div>
