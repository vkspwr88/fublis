<div>
	<div class="row g-3">
		<div class="col-md-6 col-lg-3 col-xl-3">
			<div class="row g-2">
				<div class="col-12">
					@php
						use App\Http\Controllers\Users\AvatarController as AvatarController;
						$profileImg = $publication->profileImage ?
										Storage::url($publication->profileImage->image_path) :
										AvatarController::setProfileAvatar([
											'name' => $publication->name,
											'width' => 150,
											'fontSize' => 60,
											'background' => $publication->background_color,
											'foreground' => $publication->foreground_color,
										], 'publication');
					@endphp
					<img src="{{ $profileImg }}" class="img-square img-150" alt="...">
				</div>
				<div class="col-12">
					<h4 class="p-0 m-0 text-dark fs-5 fw-semibold">{{ $publication->name }}</h4>
					<p class="p-0 m-0"><a href="{{ $publication->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($publication->website) }}</a></p>
				</div>
				@if (isArchitect())
					<div class="col-12">
						<div class="d-grid">
							<button type="button" class="btn btn-primary fw-medium" wire:click="showContact('{{ $publication->id }}')">
								Submit Story <x-users.spinners.white-btn wire:target="showContact('{{ $publication->id }}')" />
							</button>
						</div>
					</div>
				@endif
				<div class="col-12">
					<div class="row g-2">
						<div class="col-auto">
							<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-geo-alt text-secondary" viewBox="0 0 16 16">
								<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
								<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
							</svg>
						</div>
						<div class="col">
							@if($publication->publishFrom->pluck('name')->contains('Worldwide'))
								<span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize fw-semibold">worldwide</span>
							@else
								<span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize fw-semibold">{{ $city->state->country->name }}</span>
								{{-- <span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize fw-semibold">{{ $city->state->name }}</span>
								<span class="text-gray-700 bg-gray-200 badge rounded-pill text-capitalize fw-semibold">{{ $publication->location->name }}</span> --}}
							@endif
							{{-- <span class="text-gray-700 bg-gray-200 badge rounded-pill">{{ $publication->location->name }}</span> --}}
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-2">
						<div class="col-auto">
							<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-link text-secondary" viewBox="0 0 16 16">
								<path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
								<path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
							</svg>
						</div>
						<div class="col">
							<a href="{{ $publication->website }}" class="text-secondary" target="_blank">
								<span class="text-gray-700 bg-gray-200 badge rounded-pill fw-semibold">{{ trimWebsiteUrl($publication->website) }}</span>
							</a>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-2">
						<div class="col-auto">
							<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-file-bar-graph-fill text-secondary" viewBox="0 0 16 16">
								<path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 11.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z"/>
							</svg>
						</div>
						<div class="col">
							<span class="text-gray-700 bg-gray-200 badge rounded-pill fw-semibold">
								{{ $publication->monthly_visitors ? $publication->monthly_visitors . ' monthly visits' : '-' }}
							</span>
						</div>
					</div>
				</div>
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
							<span class="text-gray-700 bg-gray-200 badge rounded-pill fw-semibold">{{ $publication->starting_year ?? '-' }}</span>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-2">
						<div class="col-auto">
							<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-grid text-secondary" viewBox="0 0 16 16">
								<path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
							</svg>
						</div>
						<div class="col">
							<div class="row g-2">
								@foreach ($publication->publicationTypes as $publicationType)
									<div class="col-auto">
										<span class="text-gray-700 bg-gray-200 badge rounded-pill fw-semibold">{{ $publicationType->name }}</span>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				{{-- @if($publication->instagram)
					<div class="col-12">
						<div class="row g-2">
							<div class="col-auto">
								<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-instagram text-secondary" viewBox="0 0 16 16">
									<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
								</svg>
							</div>
							<div class="col">
								<span class="text-gray-700 bg-gray-200 badge rounded-pill fw-semibold">{{ $publication->instagram }}</span>
							</div>
						</div>
					</div>
				@endif --}}
				<div class="col-12">
					<div class="row g-2">
						<div class="col-auto">
							<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-tag text-secondary" viewBox="0 0 16 16">
								<path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
								<path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
							</svg>
						</div>
						<div class="col">
							<div class="row g-2">
								@foreach ($publication->categories as $category)
									<div class="col-auto">
										<x-utility.badges.purple-badge :text="$category->name" />
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<p class="m-0 text-secondary">
						{{ $publication->about_me }}
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-4 col-xl-3">
			<div class="bg-transparent border-0 card h-100">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-12">
							<h6 class="text-dark fs-6 fw-semibold">Associated Journalists</h6>
						</div>
						@foreach ($publication->journalists->merge($publication->associatedJournalists) as $journalist)
						<div class="col-12" wire:key="{{ $journalist->id }}">
							<div class="row g-2 align-items-center">
								<div class="col-auto">
									@php
										$profileImg = $journalist->profileImage ?
														Storage::url($journalist->profileImage->image_path) :
														AvatarController::setProfileAvatar([
															'name' => $journalist->user->name,
															'width' => 36,
															'fontSize' => 16,
															'background' => $journalist->background_color,
															'foreground' => $journalist->foreground_color,
														]);
									@endphp
									<img src="{{ $profileImg }}" alt=".." class="img-square img-36 rounded-circle">
								</div>
								<div class="col">
									<h6 class="p-0 m-0 fw-medium">
										@if (isArchitect())
											<a href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $journalist->slug]) }}" class="text-purple-800">
												{{ $journalist->user->name }}
											</a>
										@elseif (isJournalist())
											<a href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}" class="text-purple-800">
												{{ $journalist->user->name }}
											</a>
										@endif
									</h6>
									<p class="p-0 m-0 text-secondary">{{ $journalist->position->name }}</p>
								</div>
								@if (isArchitect())
									<div class="col-auto">
										<button type="button" class="btn btn-primary btn-sm rounded-pill fw-medium" wire:click="pitchJournalist('{{ $journalist->id }}')">
											Pitch <x-users.spinners.white-btn wire:target="pitchJournalist('{{ $journalist->id }}')" />
										</button>
									</div>
								@endif
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-lg-5 col-xl-6">
			<div class="bg-gray-300 border-0 shadow card rounded-4 h-100" style="min-height: 500px;">
				<iframe class="w-100 h-100 rounded-4" title="{{ $publication->name }}" src="{{ $publication->website }}" target="_blank"></iframe>
			</div>
		</div>
	</div>
	@if (isArchitect())
		@include('users.includes.architect.pitch-story-modals')
	@endif
</div>
