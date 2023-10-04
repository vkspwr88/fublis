<div>
    <div class="input-group mb-4">
		<label class="input-group-text bg-white" for="blogSearchInput"><i class="bi bi-search"></i></label>
		<input id="blogSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="searchInput" wire:keydown.enter="searchPosts" wire:focus="$set('showSearchBox', true)" />
	</div>
	@if($showSearchBox)
	<div id="searchBox" class="bg-white border rounded position-absolute w-100 p-2" style="height: 250px; top: 40px; z-index: 99; overflow-y: scroll;">
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
	/* const searchBox = $('#searchBox');
	searchBox.hide();

	$(document).on('focus', '#blogSearchInput', function(){
		searchBox.show();
	}); */
</script>
