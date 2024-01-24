@if($mediaKit->story->tags->count())
	<hr class="border-gray-300">
	<div class="row">
		<div class="col-12">
			<p class="text-dark fs-6 m-0 pb-2">Tags</p>
			<div class="row g-2 py-3">
				@foreach ($mediaKit->story->tags as $tag)
					<div class="col-auto">
						<x-users.tag :name="$tag->name" />
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif