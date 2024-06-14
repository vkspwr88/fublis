@php
	$path = resource_path('menus/guestHeaderMenu.json');
	$menus = json_decode(file_get_contents($path));
@endphp
<ul id="mobileNav" class="mt-4 list-unstyled">
	@foreach ($menus->items as $item)
		<li class="mb-1">
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
	@foreach ($menus->journalists as $item)
		<li class="mb-1">
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
					<ul class="pb-1 btn-toggle-nav list-unstyled">
						<li>
							<a class="btn btn-toggle align-items-center fs-7 fw-normal" href="{{ route('journalist.signup') }}">
								<span class="menu-title">Sign Up</span>
							</a>
						</li>
						<li>
							<a class="btn btn-toggle align-items-center fs-7 fw-normal" href="{{ route('journalist.login') }}">
								<span class="menu-title">Sign In</span>
							</a>
						</li>
						@foreach ($item->submenu as $subMenuItem)
							<li>
								@php
									$subMenuUrl = $subMenuItem->url ? (str()->contains($subMenuItem->url, 'https://') ? $subMenuItem->url : route($subMenuItem->url)) : '#' . $subMenuItem->slug;
								@endphp
								<a
									class="btn btn-toggle align-items-center fs-7 fw-normal"
									href="{{ $subMenuUrl }}"
									@if(str()->contains($subMenuItem->url, 'https://'))
										target="_blank"
									@endif
								>
									<span class="menu-title">{{ $subMenuItem->name }}</span>
								</a>
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
	<li class="mb-1">
		<button
			class="btn btn-toggle align-items-center fs-5 fw-semibold collapsed"
			data-bs-target="#architect"
			data-bs-toggle="collapse"
			aria-expanded="false"
		>
			<span class="menu-title">Pitch Now</span>
			<span class="menu-toggle-icon"></span>
		</button>
		<div class="collapse" id="architect">
			<ul class="pb-1 btn-toggle-nav list-unstyled">
				<li>
					<a class="btn btn-toggle align-items-center fs-7 fw-normal" href="{{ route('architect.login') }}">
						<span class="menu-title">Sign In</span>
					</a>
				</li>
				<li>
					<a class="btn btn-toggle align-items-center fs-7 fw-normal" href="{{ route('architect.pitch-story.index') }}">
						<span class="menu-title">Pitch Story</span>
					</a>
				</li>
			</ul>
		</div>
	</li>
</ul>
