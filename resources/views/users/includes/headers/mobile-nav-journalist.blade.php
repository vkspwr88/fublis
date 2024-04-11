@php
	$path = resource_path('menus/journalistHeaderMenu.json');
	$menus = json_decode(file_get_contents($path));
@endphp

<ul id="mobileNav" class="list-unstyled mt-4">
	<li class="mb-3">
		<form class="m-0 ms-auto" aria-label="search">
			<div class="input-group">
				<label class="bg-white input-group-text" for="headerSearchInput"><i class="bi bi-search"></i></label>
				<input id="headerSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search Media Kits, Brands" aria-label="Search">
			</div>
		</form>
	</li>
	@foreach ($menus->items as $item)
		<li class="mb-3">
			@php
				$itemUrl = $item->url ? (str()->contains($item->url, 'https://') ? $item->url : route($item->url)) : '#' . $item->slug;
			@endphp
			@if ($item->submenu)
				<button
					class="btn btn-toggle align-items-center fs-5 fw-semibold collapsed"
					data-bs-target="{{ $itemUrl }}"
					data-bs-toggle="collapse"
					aria-expanded="false"
				>
					<span class="menu-title">{{ $item->name }}</span>
					<span class="menu-toggle-icon"></span>
				</button>
				<div class="collapse" id="{{ $item->slug }}" style="">
					<ul class="btn-toggle-nav list-unstyled pb-1">
						@foreach ($item->submenu as $subMenuItem)
							<li>
								@php
									$subMenuUrl = $subMenuItem->url ? (str()->contains($subMenuItem->url, 'https://') ? $subMenuItem->url : route($subMenuItem->url)) : '#' . $subMenuItem->slug;
								@endphp
								@if ($subMenuItem->submenu)
									<button
										class="btn btn-toggle align-items-center rounded fs-6 fw-medium collapsed"
										data-bs-target="{{ $subMenuUrl }}"
										data-bs-toggle="collapse"
										aria-expanded="false"
									>
										<span class="menu-title ms-2">{{ $subMenuItem->name }}</span>
										<span class="menu-toggle-icon"></span>
									</button>
									<div class="collapse" id="{{ $subMenuItem->slug }}" style="">
										<ul class="btn-toggle-nav list-unstyled pb-1">
											@foreach ($subMenuItem->submenu as $subSubMenuItem)
												@php
													$subSubMenuUrl = $subSubMenuItem->url ? (str()->contains($subSubMenuItem->url, 'https://') ? $subSubMenuItem->url : route($subSubMenuItem->url)) : '#' . $subSubMenuItem->slug;
												@endphp
												<li>
													<a
														class="btn btn-toggle align-items-center fs-7 fw-normal"
														href="{{ $subSubMenuUrl }}"
														@if(str()->contains($subSubMenuItem->url, 'https://'))
															target="_blank"
														@endif
													>
														<span class="menu-title">{{ $subSubMenuItem->name }}</span>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								@else
									<a
										class="btn btn-toggle align-items-center fs-6 fw-medium"
										href="{{ $subSubMenuUrl }}"
										@if(str()->contains($subSubMenuItem->url, 'https://'))
											target="_blank"
										@endif
									>
										<span class="menu-title">{{ $subMenuItem->name }}</span>
									</a>
								@endif
							</li>
						@endforeach
					</ul>
				</div>
			@else
				<a
					class="btn btn-toggle align-items-center fs-5 fw-semibold"
					href="{{ $itemUrl }}"
					@if(str()->contains($item->url, 'https://'))
						target="_blank"
					@endif
				>
					<span class="menu-title">{{ $item->name }}</span>
				</a>
			@endif
		</li>
	@endforeach
	<li class="mb-3">
		<a class="btn btn-toggle align-items-center fs-5 fw-semibold" href="{{ route('journalist.account.profile.message.index') }}">
			<span class="menu-title">Messages</span>
			@inject('messageController', 'App\Http\Controllers\Users\MessageController')
				@php
					$totalUnread = $messageController::getTotalUnread();
				@endphp
				@if ($totalUnread)
					<span class="badge text-bg-danger ms-1">
						{{ $totalUnread > 9 ? '9+' : $totalUnread }}
						<span class="visually-hidden">unread messages</span>
					</span>
				@endif
		</a>
	</li>
	<li class="mb-3">
		<a class="btn btn-toggle align-items-center fs-5 fw-semibold" href="{{ route('journalist.account.profile.message.index') }}">
			<span class="menu-title">Notifications</span>
			@inject('notificationController', 'App\Http\Controllers\Users\NotificationController')
			@php
				$totalUnread = $notificationController::getTotalUnread();
			@endphp
			@if ($totalUnread)
				<span class="badge text-bg-danger ms-1">
					{{ $totalUnread > 9 ? '9+' : $totalUnread }}
					<span class="visually-hidden">unread notifications</span>
				</span>
			@endif
		</a>
	</li>
	<li class="mb-3">
		<button
			class="btn btn-toggle align-items-center fs-5 fw-semibold collapsed"
			data-bs-target="#account"
			data-bs-toggle="collapse"
			aria-expanded="false"
		>
			<span class="menu-title">Account</span>
			<span class="menu-toggle-icon"></span>
		</button>
		<div class="collapse" id="account">
			<ul class="btn-toggle-nav list-unstyled pb-1">
				@foreach ($menus->account as $item)
					<li>
						<a class="btn btn-toggle align-items-center fs-7 fw-normal" href="{{ route($item->url) }}">
							<span class="menu-title">{{ $item->name }}</span>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</li>
</ul>
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
</ul> --}}
