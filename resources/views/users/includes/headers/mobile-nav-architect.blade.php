@php
	$path = resource_path('menus/architectHeaderMenu.json');
	$menus = json_decode(file_get_contents($path));
@endphp

<ul id="mobileNav" class="mt-4 list-unstyled">
	{{-- <li class="mb-3">
		<div class="m-0 ms-auto" aria-label="search">
			<livewire:architects.header.search mobile="true" />
		</div>
	</li> --}}
	@foreach ($menus->items as $item)
		<li class="mb-1">
			@php
				$itemUrl = $item->url ? (str()->contains($item->url, 'https://') ? $item->url : route($item->url)) : '#' . $item->slug;
			@endphp
			@if ($item->submenu)
				<button
					class="btn btn-toggle align-items-center fs-4 fw-semibold collapsed"
					data-bs-target="{{ $itemUrl }}"
					data-bs-toggle="collapse"
					aria-expanded="false"
				>
					<span class="menu-title">{{ $item->name }}</span>
					<span class="menu-toggle-icon"></span>
				</button>
				<div class="collapse" id="{{ $item->slug }}" style="">
					<ul class="pb-1 btn-toggle-nav list-unstyled">
						@foreach ($item->submenu as $subMenuItem)
							<li>
								@php
									$subMenuUrl = $subMenuItem->url ? (str()->contains($subMenuItem->url, 'https://') ? $subMenuItem->url : route($subMenuItem->url)) : '#' . $subMenuItem->slug;
								@endphp
								@if ($subMenuItem->submenu)
									<button
										class="rounded btn btn-toggle align-items-center fs-6 fw-medium collapsed"
										data-bs-target="{{ $subMenuUrl }}"
										data-bs-toggle="collapse"
										aria-expanded="false"
									>
										<span class="menu-title ms-2 text-start">{{ $subMenuItem->name }}</span>
										<span class="menu-toggle-icon"></span>
									</button>
									<div class="collapse" id="{{ $subMenuItem->slug }}" style="">
										<ul class="pb-1 btn-toggle-nav list-unstyled">
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
					class="btn btn-toggle align-items-center fs-4 fw-semibold"
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
	<li class="mb-1">
		<a class="btn btn-toggle align-items-center fs-4 fw-semibold" href="{{ route('architect.account.profile.message.index') }}">
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
	<li class="mb-1">
		<a class="btn btn-toggle align-items-center fs-4 fw-semibold" href="{{ route('architect.account.profile.message.index') }}">
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
	<li class="mb-1">
		<button
			class="btn btn-toggle align-items-center fs-4 fw-semibold collapsed"
			data-bs-target="#account"
			data-bs-toggle="collapse"
			aria-expanded="false"
		>
			<span class="menu-title">Account</span>
			<span class="menu-toggle-icon"></span>
		</button>
		<div class="collapse" id="account">
			<ul class="pb-1 btn-toggle-nav list-unstyled">
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
