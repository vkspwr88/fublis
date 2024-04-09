@php
	$path = resource_path('menus/guestHeaderMenu.json');
	$menus = json_decode(file_get_contents($path));
	// dd($menus);
@endphp
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
				<ul class="nav-sub-menu" {!! count($item->submenu) == 1 ? 'style="width: 28em;"' : '' !!}>
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
<ul id="profileNav" class="flex-row mt-5 navbar-nav mt-xl-0 ms-xl-auto align-items-center">
	<livewire:common.header.message :url="route('architect.account.profile.message.index')" />
	<livewire:common.header.notification :url="route('architect.account.profile.notification')" />
	<li class="px-2 nav-item px-xl-1">
		<a href="javascript:;" class="nav-link rounded-circle p-0 {{-- dropdown-toggle --}}" role="button" data-bs-toggle="dropdown">
			<img class="rounded-circle img-40 img-square" src="{{ $profileImage }}" alt="..." />
		</a>
		<ul class="nav-sub-menu end-0" style="left: auto; width: 28em;">
			<li class="nav-sub-menu-item">
				<a class="sf-with-ul">
					<span class="nav-sub-menu-title-text">{{-- Account --}}</span>
				</a>
				<ul class="nav-sub-menu-item-ul">
					@foreach ($menus->account as $item)
						<li class="nav-sub-menu-item-li">
							<a
								href="{{ $item->url ? (str()->contains($item->url, 'https://') ? $item->url : route($item->url)) : '#' }}"
								@if(str()->contains($item->url, 'https://'))
									target="_blank"
								@endif
								class="nav-sub-menu-item-with-icon"
							>
								<span class="nav-sub-menu-icon svg-icon">
									{{-- <svg role="presentation" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
										<path d="{{ $item->icon }}"></path>
									</svg> --}}
								</span>
								<span class="nav-sub-menu-icon-text">
									<span class="nav-sub-menu-icon-title-text">{{ $item->name }}</span>
									<small class="nav-sub-menu-icon-item-desc">{{ $item->desc }}</small>
								</span>
							</a>
						</li>
					@endforeach
				</ul>
			</li>
		</ul>
	</li>
</ul>
