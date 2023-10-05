<div>
	@if($blogs->count() > 0)
		<div class="row row-cols-1 row-cols-lg-2 g-4">
			@foreach ($blogs as $blog)
				<livewire:users.blogs.index.post :blog="$blog" :key="$blog->id" />
			@endforeach
		</div>
		
		{{ $blogs->links('vendor.livewire.custom-pagination') }}
	@else
		<div class="text-center">
			<h4 class="mt-5 fw-bold">Sorry!</h4>
			<p>We couldn't find any posts according to your search criteria.</p>
		</div>
	@endif
</div>
