@isset($drafted)
	<div class="row align-items-center">
		<div class="col">
			<p class="text-dark fs-6 m-0">Description</p>
		</div>
		<div class="col text-end">
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->project_doc_path ?? $mediaKit->story->project_doc_link }}" target="_blank">Download</a>
		</div>
	</div>
	@if ( $mediaKit->story->photographs_link || count($mediaKit->story->draftPhotographs) > 0 )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Gallery</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->photographs_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->photographs_link }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="javascript:;" target="_blank">Download</a>
				@endif
			</div>
		</div>
	@endif
	@if ( $mediaKit->story->drawings_link || ($mediaKit->story->draftedDrawings && count($mediaKit->story->draftedDrawings) > 0) )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Render/Drawings</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->drawings_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->drawings_link }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="javascript:;" target="_blank">Download</a>
				@endif
			</div>
		</div>
	@endif
@else
	<div class="row align-items-center">
		<div class="col">
			<p class="text-dark fs-6 m-0">Description</p>
		</div>
		<div class="col text-end">
			@if ($mediaKit->story->project_doc_path)
				<form class="m-0 p-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="{{ $mediaKit->story->project_doc_path }}" name="file">
					<input type="hidden" name="type" value="Description">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			@else
				<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->project_doc_link }}" target="_blank">Download</a>
			@endif
		</div>
	</div>
	@if ( $mediaKit->story->photographs_link || ($mediaKit->story->photographs && $mediaKit->story->photographs->where('image_type', 'photographs')->count() > 0) )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Gallery</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->photographs_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->photographs_link }}" target="_blank">Download</a>
				@else
					<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="photographs" name="file">
						<input type="hidden" name="type" value="Gallery">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@endif
			</div>
		</div>
	@endif
	@if ( $mediaKit->story->drawings_link || ($mediaKit->story->photographs && $mediaKit->story->photographs->where('image_type', 'drawings')->count() > 0) )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Render/Drawings</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->drawings_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->drawings_link }}" target="_blank">Download</a>
				@else
					<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="drawings" name="file">
						<input type="hidden" name="type" value="Drawings">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@endif
			</div>
		</div>
	@endif
@endisset
