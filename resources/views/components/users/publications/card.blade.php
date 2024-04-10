<div>
    <div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body">
				<div class="row gx-2 gy-4">
					<div class="col-sm-auto">
						<div class="d-block mx-auto text-center">
							@php
								$cardImg = '<img src="' . ($publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/150x150') . '" class="img-square img-150" alt="...">';
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
						<div class="row align-items-center pb-4">
							<p class="fs-6 col m-0">
								@if ($publication->location)
									@php
										$country = $publication->location->city()->first()->state->country->name;
									@endphp
									<x-utility.badges.secondary-badge :text="str()->headline($country)" icon='<i class="bi bi-geo-alt"></i>' />
								@endif
								@foreach ($publication->publicationTypes as $publicationType)
									<x-utility.badges.secondary-badge :text="$publicationType->name" />
								@endforeach
								@if($publication->language)
									<x-utility.badges.secondary-badge :text="$publication->language->name" />
								@endif
							</p>
							@if(isArchitect())
								<p class="text-end fs-6 col m-0">
									<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showContact('{{ $publication->id }}')">
										Pitch Story <x-users.spinners.white-btn wire:target="showContact('{{ $publication->id }}')" />
									</button>
								</p>
							@elseif(isJournalist())
							@else
								<p class="text-end fs-6 col m-0">
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
									<div class="col-12">
										<p class="fw-medium m-0 py-2">
											<span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $publication->monthly_visitors }} monthly visits</span>
										</p>
									</div>
									@endif
									<div class="col-12">
										<h5 class="fs-6 fw-semibold m-0 pt-3">
											@if(isJournalist())
												<a href="{{ route('journalist.account.profile.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">{{ $publication->name }}</a>
											@elseif(isArchitect())
												<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">{{ $publication->name }}</a>
											@else
												<a href="javascript:;" class="text-dark" onclick="createAccountPrompt()">{{ $publication->name }}</a>
											@endif
										</h5>
										<p class="fs-6 m-0 p-0">
											<a href="{{ $publication->website }}" class="text-secondary small" target="_blank">
												{{ trimWebsiteUrl($publication->website) }}
											</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<div class="d-flex justify-content-end align-items-center flex-wrap fw-medium">
									@foreach ($publication->categories as $category)
										<x-utility.badges.purple-badge :text="$category->name" />
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
