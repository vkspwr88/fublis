<div class="row gx-3 gy-4">
	<div class="col-md-4 col-lg-3">
		<div class="row g-3">
			<div class="col-12">
				<img src="{{ $brand->profileImage ? Storage::url($brand->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}"  class="img-square img-150" alt="logo">
			</div>
			<div class="col-12">
				<h4 class="text-dark fs-5 fw-semibold m-0 p-0">{{ $brand->name }}</h4>
				<p class="m-0 p-0"><a href="{{ $brand->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($brand->website) }}</a></p>
			</div>
			@if ($viewAs === 'architect')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.profile.setting.company') }}" class="btn btn-primary fw-semibold">Edit Studio Details</a>
				</div>
			</div>
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.studio.other') }}" class="btn btn-white fw-semibold">View as others</a>
				</div>
			</div>
			@endif
			@if ($viewAs === 'other')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.studio.index') }}" class="btn btn-white fw-semibold">View as himself</a>
				</div>
			</div>
			@endif
			@if ($brand->location)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-geo-alt text-secondary" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200 text-capitalize">
							{{ $brand->location->city()->first()->state->country->name }}
						</span>
						<span class="badge rounded-pill text-gray-700 bg-gray-200 text-capitalize">
							{{ $brand->location->city()->first()->state->name }}
						</span>
						{{-- <span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->location->state->country->name }}</span>
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->location->state->name }}</span> --}}
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->location->name }}</span>
					</div>
				</div>
			</div>
			@endif
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-link text-secondary" viewBox="0 0 16 16">
							<path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
							<path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ trimWebsiteUrl($brand->website) }}</span>
					</div>
				</div>
			</div>
			@if($brand->starting_year)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-calendar2-minus text-secondary" viewBox="0 0 16 16">
							<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
							<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
							<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->starting_year }}</span>
					</div>
				</div>
			</div>
			@endif
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-grid text-secondary" viewBox="0 0 16 16">
							<path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->category->name }}</span>
					</div>
				</div>
			</div>
			@if($brand->twitter)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-twitter-x text-secondary" viewBox="0 0 16 16">
							<path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
						</svg>
					</div>
					<div class="col">
						<a href="https://{{ __('social-domains.twitter') . $brand->twitter }}" target="_blank">
							<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->twitter }}</span>
						</a>
					</div>
				</div>
			</div>
			@endif
			@if($brand->facebook)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-facebook text-secondary" viewBox="0 0 16 16">
							<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
						</svg>
					</div>
					<div class="col">
						<a href="https://{{ __('social-domains.facebook') . $brand->facebook }}" target="_blank">
							<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->facebook }}</span>
						</a>
					</div>
				</div>
			</div>
			@endif
			@if($brand->instagram)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-instagram text-secondary" viewBox="0 0 16 16">
							<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
						</svg>
					</div>
					<div class="col">
						<a href="https://{{ __('social-domains.instagram') . $brand->instagram }}" target="_blank">
							<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->instagram }}</span>
						</a>
					</div>
				</div>
			</div>
			@endif
			@if($brand->linkedin)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-linkedin text-secondary" viewBox="0 0 16 16">
							<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
						  </svg>
					</div>
					<div class="col">
						<a href="https://{{ __('social-domains.linkedin') . $brand->linkedin }}" target="_blank">
							<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->linkedin }}</span>
						</a>
					</div>
				</div>
			</div>
			@endif
			@if(count($tags) > 0)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-tag text-secondary" style="margin-top: 5px;" viewBox="0 0 16 16">
							<path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
							<path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
						</svg>
					</div>
					<div class="col">
						@foreach ($tags as $tag)
						<span class="badge rounded-pill text-purple-700 bg-purple-100">{{ $tag }}</span>
						@endforeach
					</div>
				</div>
			</div>
			@endif
			@if($brand->about_me)
			<div class="col-12">
				<p class="m-0 text-secondary">{{ $brand->about_me }}</p>
			</div>
			@endif
		</div>
		<hr class="border-gray-300 my-4">
		<div class="row g-3">
			<div class="col-12">
				<h4 class="fs-5 text-dark fw-semibold">Team Members</h4>
			</div>
			<div class="col-12">
				<div class="row g-2">
					@foreach ($brand->architects as $architect)
					<div class="col-12">
						<div class="row g-2 align-items-center">
							<div class="col-auto">
								<img src="{{ $architect->profileImage ? Storage::url($architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt=".." class="rounded-circle img-square img-48">
							</div>
							<div class="col">
								<h6 class="fw-medium m-0 p-0">
									@if ($viewAs === 'architect')
									<a class="text-purple-800" href="{{ route('architect.account.profile.index') }}">
										{{ $architect->user->name }}
									</a>
									@elseif ($viewAs === 'journalist')
									<a class="text-purple-800" href="{{ route('journalist.brand.architect', ['architect' => $architect->slug]) }}">
										{{ $architect->user->name }}
									</a>
									@endif
									
								</h6>
								<p class="text-secondary m-0 p-0">{{ $architect->position->name }}</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			@if ($viewAs === 'architect')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.profile.setting.team') }}" class="btn btn-primary fw-semibold">Edit Team</a>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="col-md-8 col-lg-9">
		<div class="row g-4">
			<div class="col-12">
				<div class="row align-items-center g-3">
					<div class="col-auto">
						<span class="badge rounded-pill text-purple-700 bg-purple-100">Press Release <a href="#" class="ms-2 text-purple-700">X</i></a></span>
						<span class="badge rounded-pill text-purple-700 bg-purple-100">India <a href="#" class="ms-2 text-purple-700">X</a></span>
						<button type="button" class="btn btn-white btn-sm fw-semibold">
							<i class="bi bi-filter"></i> More filters
						</button>
					</div>
					<div class="col">
						<div class="d-flex justify-content-end">
							<div class="input-group" style="width: 280px;">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search media kit by name" aria-label="Search" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				@if ($viewAs == 'architect')
				<x-users.media-kits.architect-list :mediaKits="$mediaKits" />
				@elseif ($viewAs == 'journalist')
				<x-users.media-kits.journalist-list :mediaKits="$mediaKits" />
				@endif
			</div>
		</div>
	</div>
</div>
