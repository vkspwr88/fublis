<div class="row gx-3 gy-4">
	<div class="col-md-4 col-lg-3">
		<div class="row g-3">
			<div class="col-12">
				@php
					use App\Http\Controllers\Users\AvatarController as AvatarController;
					$architectProfileImg = $architect->profileImage ?
											Storage::url($architect->profileImage->image_path) :
											AvatarController::setProfileAvatar([
												'name' => $architect->user->name,
												'width' => 150,
												'fontSize' => 75,
												'background' => $architect->background_color,
												'foreground' => $architect->foreground_color,
											]);
				@endphp
				<img src="{{ $architectProfileImg }}" class="img-square img-150" alt="logo">
			</div>
			<div class="col-12">
				<h4 class="p-0 m-0 text-dark fs-5 fw-semibold">{{ $architect->user->name }}</h4>
				<p class="p-0 m-0 text-secondary">{{ $architect->position->name }}</p>
			</div>
			@if ($viewAs === 'architect')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.profile.setting.personal-info') }}" class="btn btn-primary fw-semibold">Edit Profile</a>
				</div>
			</div>
			@endif
			@if ($architect->location)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-geo-alt text-secondary" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>
					</div>
					<div class="col">
						@php
							$city = $architect->location->city()->first();
						@endphp
						<span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize">
							{{ $city->state->country->name }}
						</span>
						<span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize">
							{{ $city->state->name }}
						</span>
						{{-- <span class="text-gray-700 bg-gray-200 badge rounded-pill">{{ $architect->location->state->country->name }}</span>
						<span class="text-gray-700 bg-gray-200 badge rounded-pill">{{ $architect->location->state->name }}</span> --}}
						<span class="text-gray-700 bg-gray-200 badge rounded-pill">{{ $architect->location->name }}</span>
					</div>
				</div>
			</div>
			@endif
			@if ($architect->company->category)
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door text-secondary" viewBox="0 0 16 16">
							<path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
						</svg>
					</div>
					<div class="col">
						<span class="text-gray-700 bg-gray-200 badge rounded-pill">{{ $architect->company->category->name }}</span>
					</div>
				</div>
			</div>
			@endif
			@if ($architect->about_me)
			<div class="col-12">
				<p class="m-0 text-secondary">{{ $architect->about_me }}</p>
			</div>
			@endif

		</div>
		<hr class="my-4 border-gray-300">
		<div class="row g-3">
			<div class="col-12">
				<h4 class="text-purple-700 fs-5 fw-semibold">Brand</h4>
			</div>
			<div class="col-12">
				<div class="row g-2 align-items-center">
					<div class="col-auto">
						@php
							$studioProfileImg = $architect->company->profileImage ?
													Storage::url($architect->company->profileImage->image_path) :
													AvatarController::setProfileAvatar([
														'name' => $architect->company->name,
														'width' => 48,
														'fontSize' => 24,
														'background' => $architect->company->background_color,
														'foreground' => $architect->company->foreground_color,
													]);
						@endphp
						<img src="{{ $studioProfileImg }}" alt=".." class="rounded-circle img-square img-48">
					</div>
					<div class="col">
						<h6 class="p-0 m-0 fs-6 fw-medium">
							@if ($viewAs === 'architect')
							<a href="{{ route('architect.account.studio.index') }}" class="text-dark">
								{{ $architect->company->name }}
							</a>
							@elseif ($viewAs === 'journalist')
							<a href="{{ route('journalist.brand.view', ['brand' => $architect->company->slug]) }}" class="text-dark">
								{{ $architect->company->name }}
							</a>
							@endif
						</h6>
						<p class="p-0 m-0">
							<a href="{{ $architect->company->website }}" class="text-secondary" target="_blank">
								{{ trimWebsiteUrl($architect->company->website) }}
							</a>
						</p>
					</div>
				</div>
			</div>
			@if ($viewAs === 'architect')
			<div class="col-12">
				<div class="d-grid">
					<a href="{{ route('architect.account.profile.setting.company') }}" class="btn btn-primary fw-semibold">Edit Brand Page</a>
				</div>
			</div>
			@endif
		</div>
	</div>
	<div class="col-md-8 col-lg-9">
		<div class="row g-4">
			@include('users.includes.common.profile-media-kit-filter-form')
			<div class="col-12" wire:loading.remove>
				@if ($viewAs == 'architect')
				<x-users.media-kits.architect-list :mediaKits="$filterredMediaKits" />
				@elseif ($viewAs == 'journalist')
				<x-users.media-kits.journalist-list :mediaKits="$filterredMediaKits" />
				@endif
			</div>
			<div class="col-12" wire:loading>
				<div class="bg-white border-0 shadow card rounded-3">
					<div class="text-center card-body">
						<h4 class="py-3 m-0 text-purple-900 card-title fs-5 fw-semibold">
							Searching <x-users.spinners.primary-btn />
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
