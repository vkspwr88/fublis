<nav id="header" class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
			data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
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
		</div>
	</div>
</nav>
