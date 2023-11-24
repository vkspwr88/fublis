<div class="col-12">
	@if($posts->count() > 0)
	<div class="row g-4">
		@foreach ($posts as $post)
		<div class="col-12" wire:key="{{ $post->id }}">
			<div class="card rounded-4 shadow border-0">
				<div class="card-body">
					<a href="{{ $post->post_url }}" class="stretched-link" target="_blank"></a>
					<div class="row g-3">
						<div class="col-12">
							<div class="row justify-content-center pb-2">
								<p class="text-secondary fs-6 fw-semibold col m-0">{{ $post->story_type }}</p>
								<p class="text-end text-secondary fs-6 fw-semibold col m-0">{{ $post->category->name }}</p>
							</div>
						</div>
						<div class="col-12 text-dark">
							<h4 class="fs-5 fw-semibold">{{ $post->meta_title }}</h4>
							<p class="fs-6">{{ $post->meta_content }}</p>
						</div>
						<div class="col-12">
							<div class="row align-items-center">
								<div class="col">
									<p class="text-dark fs-6 fw-bold m-0">
										<img class="rounded-circle img-square img-30 me-2" src="{{ $post->publication->profileImage ? Storage::url($post->publication->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" alt="..." />
										{{ $post->publication->name }}
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	{{ $posts->links('vendor.livewire.custom-pagination') }}
	@else
	<div class="row">
		<div class="col-12">
			<div class="card border-0 rounded-3 bg-white shadow">
				<div class="card-body text-center">
					<h4 class="card-title text-purple-900 fs-5 fw-semibold m-0 py-3">No result found.</h4>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
