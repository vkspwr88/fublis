@php
	$path = resource_path('menus/guestHeaderMenu.json');
	$menus = json_decode(file_get_contents($path));
	// dd($menus);
@endphp
<header id="header" class="bg-white shadow-sm navbar navbar-expand-xl fixed-top m-0 p-0">
	<div class="container h-100">
		<a class="navbar-brand" href="{{ route('home') }}">
			<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<nav id="headerNav" class="d-flex h-100 w-100">
			<ul class="navbar-nav me-auto d-flex align-items-center">
				@foreach ($menus->items as $item)
					<li class="nav-item">
						<a
							class="nav-link"
							href="{{ $item->url ? (str()->contains($item->url, 'https://') ? $item->url : route($item->url)) : '#' }}"
							@if(str()->contains($item->url, 'https://'))
								target="_blank"
							@endif
							aria-expanded="false"
						>
							<span class="nav-text">{{ $item->name }}</span>
							@if ($item->submenu)
								<span class="nav-sub-indicator"><i class="bi bi-chevron-down"></i></span>
							@endif
						</a>
						@if ($item->submenu)
							<ul class="nav-sub-menu">
								@foreach ($item->submenu as $subMenuItem)
									<li class="nav-sub-menu-item">
										<a class="sf-with-ul">
											<span class="nav-sub-menu-title-text">{{ $subMenuItem->name }}</span>
										</a>
										@if ($subMenuItem->submenu)
										<ul class="nav-sub-menu-item-ul">
											@foreach ($subMenuItem->submenu as $subSubMenuItem)
												<li class="nav-sub-menu-item-li">
													<a
														href="{{ $subSubMenuItem->url ? (str()->contains($subSubMenuItem->url, 'https://') ? $subSubMenuItem->url : route($subSubMenuItem->url)) : '#' }}"
														@if(str()->contains($subSubMenuItem->url, 'https://'))
															target="_blank"
														@endif
														class="nav-sub-menu-item-with-icon"
													>
														<span class="nav-sub-menu-icon svg-icon">
															<svg role="presentation" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
																<path d="{{ $subSubMenuItem->icon }}"></path>
															</svg>
														</span>
														<span class="nav-sub-menu-icon-text">
															<span class="nav-sub-menu-icon-title-text">{{ $subSubMenuItem->name }}</span>
															<small class="nav-sub-menu-icon-item-desc">{{ $subSubMenuItem->desc }}</small>
														</span>
													</a>
												</li>
											@endforeach
										</ul>
										@endif
									</li>
								@endforeach
							</ul>
						@endif
					</li>
				@endforeach
			</ul>
			<ul class="navbar-nav ms-auto d-flex align-items-center">
				@foreach ($menus->journalists as $item)
					<li class="nav-item">
						<a
							class="nav-link"
							href="{{ $item->url ? (str()->contains($item->url, 'https://') ? $item->url : route($item->url)) : '#' }}"
							@if(str()->contains($item->url, 'https://'))
								target="_blank"
							@endif
							aria-expanded="false"
						>
							<span class="nav-text">{{ $item->name }}</span>
							@if ($item->submenu)
								<span class="nav-sub-indicator"><i class="bi bi-chevron-down"></i></span>
							@endif
						</a>
						<ul class="nav-sub-menu end-0" style="left: auto; width: 35em">
							<li class="nav-sub-menu-item" style="flex: none; width: 162px; background-color: #f2f2f2;">
								<ul class="nav-sub-menu-item-ul">
									<li class="nav-sub-menu-item-li">
										<a class="sf-with-ul">
											<span class="nav-sub-menu-icon-title-text">Start seeking fresh stories</span>
										</a>
									</li>
									<li class="nav-sub-menu-item-li">
										<a href="{{ route('journalist.signup') }}" class="btn btn-primary px-3 fs-7">
											<small>Sign Up</small>
										</a>
									</li>
									<li class="nav-sub-menu-item-li pt-5">
										<a class="sf-with-ul">
											<span class="nav-sub-menu-title-text">Already member?</span>
										</a>
									</li>
									<li class="nav-sub-menu-item-li">
										<a href="{{ route('journalist.login') }}" class="btn px-3 fs-7" style="background-color: #4f4f4f; color: #fff;">
											<small>Sign In</small>
										</a>
									</li>
								</ul>
							</li>
							@if ($item->submenu)
								<li class="nav-sub-menu-item">
									<a class="sf-with-ul">
										<span class="nav-sub-menu-title-text"></span>
									</a>
									<ul class="nav-sub-menu-item-ul">
										@foreach ($item->submenu as $subSubMenuItem)
											<li class="nav-sub-menu-item-li">
												<a
													href="{{ $subSubMenuItem->url ? (str()->contains($subSubMenuItem->url, 'https://') ? $subSubMenuItem->url : route($subSubMenuItem->url)) : '#' }}"
													@if(str()->contains($subSubMenuItem->url, 'https://'))
														target="_blank"
													@endif
													class="nav-sub-menu-item-with-icon"
												>
													<span class="nav-sub-menu-icon svg-icon">
														<svg role="presentation" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
															<path d="{{ $subSubMenuItem->icon }}"></path>
														</svg>
													</span>
													<span class="nav-sub-menu-icon-text">
														<span class="nav-sub-menu-icon-title-text">{{ $subSubMenuItem->name }}</span>
														<small class="nav-sub-menu-icon-item-desc">{{ $subSubMenuItem->desc }}</small>
													</span>
												</a>
											</li>
										@endforeach
									</ul>
								</li>
							@endif
						</ul>
					</li>
				@endforeach
				<li class="nav-item">
					<a class="nav-link" href="{{ route('architect.login') }}">
						<span class="nav-text">Sign In</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="btn btn-primary hover" href="{{ route('architect.login') }}">
						<span class="nectar-menu-icon svg-icon">
							<svg style="width: 18px; height: 18px; color: #fff; fill: #fff;" role="presentation" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
								<path d="M10.959 31.651c-0.093 0-0.191-0.019-0.28-0.060-0.299-0.139-0.451-0.472-0.361-0.789l3.628-12.745-8.113 1.695c-0.217 0.039-0.437-0.024-0.596-0.169-0.159-0.151-0.233-0.369-0.199-0.588l2.456-15.415c0.044-0.268 0.248-0.481 0.512-0.544l11.433-2.667c0.237-0.060 0.492 0.025 0.653 0.211 0.164 0.188 0.208 0.448 0.12 0.677l-3.319 8.601 9.243-2.399c0.268-0.075 0.552 0.031 0.713 0.257 0.159 0.225 0.164 0.528 0.008 0.752l-15.341 22.881c-0.129 0.195-0.341 0.301-0.557 0.301zM14.889 16.513c0.184 0 0.361 0.076 0.487 0.213 0.159 0.169 0.219 0.412 0.153 0.636l-2.773 9.751 12.012-17.916-8.804 2.283c-0.245 0.057-0.5-0.019-0.665-0.2-0.167-0.191-0.212-0.451-0.125-0.685l3.336-8.639-9.775 2.277-2.233 14.021 8.247-1.721c0.049-0.015 0.095-0.020 0.141-0.020z"></path>
							</svg>
						</span>
						<span class="small animated_text">
							<span class="char" style="animation-delay: 0s;">P</span><span class="char" style="animation-delay: 0.015s;">i</span><span class="char" style="animation-delay: 0.03s;">t</span><span class="char" style="animation-delay: 0.045s;">c</span><span class="char" style="animation-delay: 0.06s;">h</span> <span class="char" style="animation-delay: 0.075s;">n</span><span class="char" style="animation-delay: 0.09s;">o</span><span class="char" style="animation-delay: 0.105s;">w</span>
						</span>
					</a>
				</li>
			</ul>
		</nav>
		{{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
			<div class="offcanvas-header">
				<a class="navbar-brand" href="{{ route('home') }}">
					<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
				</a>
			  	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">

			</div>
		</div> --}}
	</div>
</header>
