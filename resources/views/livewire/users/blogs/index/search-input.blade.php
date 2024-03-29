<div class="click-text">
    <div class="input-group mb-4">
		<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
		<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="searchInput" wire:keydown.enter="searchPosts" wire:focus="$set('showSearchBox', true)" />
	</div>
	@if($showSearchBox)
	<div id="searchBox" class="bg-white border rounded position-absolute w-100 p-2">
		<div wire:loading>Searching posts...</div>
		<div wire:loading.remove>
			@if ($searchInput == "")
				<div class="text-muted text-sm">
					Press enter to search for posts.
				</div>
			@else
				<div>
					@if(empty($postsByName) && empty($postsByAuthor) && empty($postsByTags))
						No result found
					@else
						@if(!empty($postsByName))
							<h6 class="m-0 bg-purple-800 text-white p-2 rounded">Title</h6>
							<ul class="list-group list-group-flush">
								@forelse ($postsByName as $blog)
								<li class="list-group-item d-flex justify-content-between align-items-start px-0">
									<div class="ms-2 me-auto w-100">
										<div class="fw-bold text-truncate">{{ $blog->title }}</div>
										<div class="text-truncate">{{ $blog->description }}</div>
										<a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}" class="stretched-link"></a>
									</div>
								</li>
								@empty
								<li class="list-group-item d-flex justify-content-between align-items-start px-0 text-muted">
									No result found
								</li>
								@endforelse
							</ul>
						@endif
						@if(!empty($postsByAuthor))
							<h6 class="m-0 bg-purple-800 text-white p-2 rounded">Authors</h6>
							<ul class="list-group list-group-flush">
								@forelse ($postsByAuthor as $blog)
								<li class="list-group-item d-flex justify-content-between align-items-start px-0">
									<div class="ms-2 me-auto w-100">
										<div class="fw-bold text-truncate">{{ $blog->title }}</div>
										<div class="text-truncate">{{ $blog->description }}</div>
										<a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}" class="stretched-link"></a>
									</div>
								</li>
								@empty
								<li class="list-group-item d-flex justify-content-between align-items-start px-0 text-muted">
									No result found
								</li>
								@endforelse
							</ul>
						@endif
						@if(!empty($postsByTags))
							<h6 class="m-0 bg-purple-800 text-white p-2 rounded">Tags</h6>
							<ul class="list-group list-group-flush">
								@forelse ($postsByTags as $blog)
								<li class="list-group-item d-flex justify-content-between align-items-start px-0">
									<div class="ms-2 me-auto w-100">
										<div class="fw-bold text-truncate">{{ $blog->title }}</div>
										<div class="text-truncate">{{ $blog->description }}</div>
										<a href="{{ route('blogs.show', ['slug' => $blog->slug]) }}" class="stretched-link"></a>
									</div>
								</li>
								@empty
								<li class="list-group-item d-flex justify-content-between align-items-start px-0 text-muted">
									No result found
								</li>
								@endforelse
							</ul>
						@endif
					@endif
				</div>
			@endif
		</div>
	</div>
	@endif
</div>

@stack('script')
<script>
	const concernedElement = document.querySelector(".click-text");
	const searchBox = $('#searchBox');

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
			const showSearchBox = Livewire.getByName('users.blogs.index.search-input')[0].get('showSearchBox');
			if(showSearchBox){
				//searchBox.hide();
				Livewire.getByName('users.blogs.index.search-input')[0].set('showSearchBox', false);
			}
		}
	});
	/* const searchBox = $('#searchBox');
	searchBox.hide();

	$(document).on('focus', '#filterSearchInput', function(){
		searchBox.show();
	}); */
</script>
