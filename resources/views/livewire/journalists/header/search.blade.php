<div class="click-text">
    <div class="input-group">
		<label class="bg-white input-group-text" for="headerSearchInput"><i class="bi bi-search"></i></label>
		<input id="headerSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search Media Kits, Brands" aria-label="Search" wire:model="searchInput" wire:keydown.enter="search" wire:focus="showSearch">
	</div>
	@if($showSearchBox)
		@if($mobile)
			<div id="searchBox" class="rounded-2 bg-white position-absolute p-2" style="width: 100%; height: 250px; top: 45px; border: 1px solid rgba(0,0,0,.075); overflow-y: scroll;">
		@else
			<div id="searchBox" class="rounded-2 bg-white position-absolute p-2" style="width: 301px; height: 250px; top: 75px; border: 1px solid rgba(0,0,0,.075); overflow-y: scroll;">
		@endif
			<div wire:loading wire:target="search">Searching <x-users.spinners.primary-btn /></div>
			<div wire:loading.remove>
				@if ($searchInput == "")
					<div class="text-muted text-sm">
						Press enter to search.
					</div>
				@else
					<div>
						<h6 class="m-0 bg-purple-800 text-white p-2 rounded">Media Kits</h6>
						<ul class="list-group list-group-flush">
							@forelse ($mediaKits as $mediaKit)
							<li class="list-group-item d-flex justify-content-between align-items-start px-0" wire:key="{{ $mediaKit->id }}">
								<div class="row g-2">
									<div class="col-auto">
										<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" class="rounded-circle img-45 img-square" alt="..." />
									</div>
									<div class="col">
										<div class="fw-bold text-truncate">{{ $mediaKit->story->title }}</div>
										<div class="text-truncate">{{ $mediaKit->architect->company->name }}</div>
									</div>
									<a href="{{ route('journalist.media-kit.view', ['mediaKit' => $mediaKit->slug]) }}" class="stretched-link"></a>
								</div>
							</li>
							@empty
							<li class="list-group-item d-flex justify-content-between align-items-start px-0 text-muted">
								No result found
							</li>
							@endforelse
						</ul>
						<h6 class="m-0 bg-purple-800 text-white p-2 rounded">Brands</h6>
						<ul class="list-group list-group-flush">
							@forelse ($brands as $brand)
							<li class="list-group-item d-flex justify-content-between align-items-start px-0" wire:key="{{ $brand->id }}">
								<div class="row g-2">
									<div class="col-auto">
										@php
											$profileImg = App\Http\Controllers\Users\AvatarController::getProfileAvatar($brand, 'studio');
										@endphp
										<img src="{{ $profileImg }}" class="rounded-circle img-45 img-square" alt="..." />
									</div>
									<div class="col">
										<div class="fw-bold text-truncate">{{ $brand->name }}</div>
										<div class="text-truncate">{{ trimWebsiteUrl($brand->website) }}</div>
									</div>
									<a href="{{ route('journalist.brand.view', ['brand' => $brand->slug]) }}" class="stretched-link"></a>
								</div>
							</li>
							@empty
							<li class="list-group-item d-flex justify-content-between align-items-start px-0 text-muted">
								No result found
							</li>
							@endforelse
						</ul>
					</div>
				@endif
			</div>
		</div>
	@endif
</div>

@stack('script')
<script>
	concernedElement = document.querySelector(".click-text");
	searchBox = $('#searchBox');

	document.addEventListener('livewire:initialized', () => {
		//console.log(Livewire.getByName('users.blogs.index.search-input')[0].get('showSearchBox'));
		//console.log($wire);
	});

	document.addEventListener("mousedown", (event) => {
		if (concernedElement.contains(event.target)) {
			//searchBox.show();
			//console.log("Clicked Inside");
		} else {
			//console.log("Clicked Outside / Elsewhere");
			const showSearchBox = Livewire.getByName('journalists.header.search')[0].get('showSearchBox');
			if(showSearchBox){
				//searchBox.hide();
				Livewire.getByName('journalists.header.search')[0].set('showSearchBox', false);
			}
		}
	});
</script>
