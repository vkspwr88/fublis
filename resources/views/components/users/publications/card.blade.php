<div>
    <div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body">
				<div class="row gx-2 gy-4">
					<div class="col-sm-auto">
						<div class="d-block mx-auto text-center">
							<img src="{{ $publication->profileImage ? Storage::url($publication->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="...">
						</div>
					</div>
					<div class="col-sm d-flex flex-column justify-content-between">
						<div class="row align-items-center pb-4">
							<p class="fs-6 col m-0">
								<span class="badge rounded-pill text-bg-secondary mb-1">
									<i class="bi bi-geo-alt"></i>
									{{ $publication->location->name }}
								</span>
								@foreach ($publication->publicationTypes as $publicationType)
								<span class="badge rounded-pill text-bg-secondary mb-1">{{ $publicationType->name }}</span>
								@endforeach
								@if($publication->language)
								<span class="badge rounded-pill text-bg-secondary mb-1">
									{{ $publication->language->name }}
								</span>
								@endif
							</p>
							@if(isArchitect())
								<p class="text-end fs-6 col m-0">
									<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="showContact('{{ $publication->id }}')">
										Pitch Story <x-users.spinners.white-btn wire:target="showContact('{{ $publication->id }}')" />
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
											@endif
											@if(isArchitect())
												<a href="{{ route('architect.pitch-story.publications.view', ['publication' => $publication->slug]) }}" class="text-dark">{{ $publication->name }}</a>
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
										<span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $category->name }}</span>
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