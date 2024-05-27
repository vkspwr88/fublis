<div>
    <div class="col-12">
		<div class="bg-white border-0 shadow card rounded-3">
			<div class="card-body">
				<div class="row gx-2 gy-4">
					<div class="col-sm-auto">
						<div class="mx-auto text-center d-block">
							@php
								$profileImg = App\Http\Controllers\Users\AvatarController::getProfileAvatar($publication, 'publication');
								$cardImg = '<img src="' . $profileImg . '" class="img-square img-150" alt="...">';
							@endphp
							@if(isJournalist())
								<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}">
									{!! $cardImg !!}
								</a>
							@elseif(isArchitect())
								<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}">
									{!! $cardImg !!}
								</a>
							@else
								<a href="javascript:;" class="text-dark" onclick="createAccountPrompt()">
									{!! $cardImg !!}
								</a>
							@endif
						</div>
					</div>
					<div class="col-sm d-flex flex-column justify-content-between">
						<div class="pb-4 row align-items-center">
							<p class="m-0 fs-6 col">
								@if ($publication->is_premium)
									<x-utility.badges.premium-badge text="Premium" />
								@endif
								@if($publication->publishFrom->pluck('name')->contains('Worldwide'))
									<x-utility.badges.secondary-badge text="Worldwide" icon='<i class="bi bi-geo-alt"></i>' />
								@else
									@if ($publication->location)
										@php
											$country = $publication->location->city()->first()->state->country->name;
										@endphp
										<x-utility.badges.secondary-badge :text="str()->headline($country)" icon='<i class="bi bi-geo-alt"></i>' />
									@endif
								@endif
								@foreach ($publication->publicationTypes as $publicationType)
									<x-utility.badges.secondary-badge :text="$publicationType->name" />
								@endforeach
								@if($publication->language)
									<x-utility.badges.secondary-badge :text="$publication->language->name" />
								@endif
							</p>
							@if(isArchitect())
								<p class="m-0 text-end fs-6 col">
									<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showContact('{{ $publication->id }}')">
										Pitch Story <x-users.spinners.white-btn wire:target="showContact('{{ $publication->id }}')" />
									</button>
								</p>
							@elseif(isJournalist())
							@else
								<p class="m-0 text-end fs-6 col">
									<button type="button" class="btn btn-primary btn-sm fw-medium" onclick="createAccountPrompt()">
										Pitch Story
									</button>
								</p>
							@endif
						</div>
						<div class="row justify-content-end align-items-end g-4">
							<div class="col">
								<div class="row justify-content-center">
									@if($publication->monthly_visitors)
									{{-- <div class="col-12">
										<p class="py-2 m-0 fw-medium">
											<span class="text-purple-700 badge rounded-pill bg-purple-50">{{ $publication->monthly_visitors }} monthly visits</span>
										</p>
									</div> --}}
									@endif
									<div class="col-12">
										<h5 class="pt-3 m-0 fs-6 fw-semibold">
											@if(isJournalist())
												<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">{{ $publication->name }}</a>
											@elseif(isArchitect())
												<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">{{ $publication->name }}</a>
											@else
												<a href="javascript:;" class="text-dark" onclick="createAccountPrompt()">{{ $publication->name }}</a>
											@endif
										</h5>
										<p class="p-0 m-0 fs-6">
											<a href="{{ $publication->website }}" class="text-secondary small" target="_blank">
												{{ trimWebsiteUrl($publication->website) }}
											</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<div class="flex-wrap d-flex justify-content-end align-items-center fw-medium">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
